<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Thread;
use App\Traits\CheckEmpresaTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessageController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * MessageController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;


        $this->middleware('auth');
    }

    /**
     *
     */
    protected function checkCensored()
    {
        $messages['not_contains'] = 'The :attribute must not contain banned words';
        if($this->request->method() == 'POST') {
            // Adjust the rules as needed
            $this->validate($this->request,
                [
                    'name'          => 'not_contains',
                    'about'         => 'not_contains',
                    'title'         => 'not_contains',
                    'description'   => 'not_contains',
                    'tag'           => 'not_contains',
                    'email'         => 'not_contains',
                    'body'          => 'not_contains',
                    'link'          => 'not_contains',
                    'address'       => 'not_contains',
                    'website'       => 'not_contains',
                    'display_name'  => 'not_contains',
                    'key'           => 'not_contains',
                    'value'         => 'not_contains',
                    'subject'       => 'not_contains',
                    'username'      => 'not_contains',
                    'email'         => 'email',
                ],$messages);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();
        $empresa = Empresa::findOrFail(1);

        // All threads that user is participating in
        // $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenges.index', compact('threads', 'empresa'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function get_active_chat(Request $request)
    {
        try {
            $thread = Thread::findOrFail($request->input('message_id'));
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: '.$request->input('message_id').' was not found.');

            return redirect('messages');
        }

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        $messages = [];
        $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(5);

        // return response()->json(['success' => true, 'data' => $thread, 'message_id' => $id]);
        return response()->json(['success' => true, 'data' => view('messenges.chat.active_chat')->with('thread',$thread)->render(), 'message_id' => $request->input('message_id')]);

    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $this->checkEmpresa($request->post('empresa_id'));
        $empresa = Empresa::findOrFail($request->post('empresa_id'));
        $users_empresa = json_encode($this->_make_users_empresa($empresa));
        return view('messenges.create', compact('empresa', 'users_empresa'));
    }

    /**
     * @param $data
     * @return array
     */
    private function _make_users_empresa($data) {

        $members_and_teams_dropdown = array();

        foreach ($data->users as $member) {
            $members_and_teams_dropdown[] = array("type" => "member", "id" => $member->id, "text" => $member->nombre . " " . $member->apellido);
        }

        return $members_and_teams_dropdown;
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $files = $this->serializeFiles($request);

        $recipients = explode(',', $request->post('recipients'));
        $recipients[1] = (string) Auth::id();
        $thread = Thread::whereHas('participants', function ($query) use ($recipients) {
            $query->whereIn('user_id', $recipients)
                ->groupBy('thread_id')
                ->havingRaw('COUNT(thread_id)='.count($recipients));
        })->first();




        if (!$thread) {
            $thread = Thread::create(
                [
                    'subject' => isset($input['subject']) ? $input['subject'] : '',
                ]
            );



            // Sender
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id,
                    'last_read' => new Carbon()
                ]
            );



            // Recipients
            if (Input::has('recipients')) {
                $recipients = explode(',',  $request->post('recipients'));
                $recipients[0] = (string) Auth::id();
                $thread->addParticipant($recipients);
            }
        }

        $message = new Message([
            'user_id'   => Auth::user()->id,
            'body'      => $input['body'],
            'files' => $files
        ]);

        $thread->messages()->save($message);



        $thread = Thread::findOrFail($thread->id);


        $thread->lastMessage = $thread->latestMessage;

        $participants = $thread->participants()->get();

        foreach ($participants as $key => $participant) {
            if (Auth::id() != $participant->user->id) {
                // echo $participant->user->id;
              //  Event::fire(new MessagePublished($message, $participant->user));
            }
            if ($participant->user->id != Auth::user()->id) {
                $thread->user = $participant->user;
            }
        }

        return response()->json(["success" => true,  'message' => 'Mensaje enviado', "id" => $thread->id]);

    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        $files = $this->serializeFiles($request);

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('reply_message'),
                'files' => $files
            ]
        );

        $message->user = $message->user;

        $thread->activateAllParticipants();
        // activate all participants
        $participants = $thread->participants()->withTrashed()->get();
        foreach ($participants as $participant) {
            $participant->restore();
            if (Auth::id() != $participant->user->id) {
                // echo $participant->user->id;
               // Event::fire(new MessagePublished($message, $participant->user));
            }
        }


        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon();
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return response()->json(["success" => true,  'message' => 'Respuesta enviada', 'data' => view('messenges.reply_row')->with('message',$message)->render()]);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function serializeFiles(Request $request)
    {
        $files_data = array();
        $file_names = $request->post("file_names");
        $file_sizes = $request->post("file_sizes");

        if ($file_names && $this->get_array_value($file_names, 0)) {
            foreach ($file_names as $key => $file_name) {
                $files_data[] = array(
                    "file_name" => $file_name,
                    "file_size" => $this->get_array_value($file_sizes, $key)
                );
            }
        }

        return serialize($files_data);
    }

    /**
     * @param array $array
     * @param $key
     * @return mixed
     */
    protected  function get_array_value(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages()
    {
        $currentUserId = Auth::user()->id;
        $result = array();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(30);

        foreach ($threads as $key => $thread) {
            $thread->unread = $thread->isUnread($currentUserId);

            $thread->lastMessage = $thread->latestMessage;

            $participants = $thread->participants()->get();

            foreach ($participants as $key => $participant) {
                if ($participant->user->id != Auth::user()->id) {
                    $thread->user = $participant->user;
                    break;
                }
            }
        }

        foreach ($threads as $messages) {
            $result[] = $this->_make_row($messages);
        }



        return response()->json(['data' => $result]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function getMessage($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: '.$id.' was not found.');

            return redirect('messages');
        }

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        $messages = [];
        $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(5);



        // return response()->json(['success' => true, 'data' => $thread, 'message_id' => $id]);
        return response()->json(['success' => true, 'data' => view('messenges.view')->with('thread',$thread)->render(), 'message_id' => $id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function view(Request $request)
    {
        try {
            $thread = Thread::findOrFail($request->input('message_id'));
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: '.$request->input('message_id').' was not found.');

            return redirect('messages');
        }

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        $messages = [];
        $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(5);



        // return response()->json(['success' => true, 'data' => $thread, 'message_id' => $id]);
        return response()->json(['success' => true, 'data' => view('messenges.chat.active_chat')->with('thread',$thread)->render(), 'message_id' => $request->input('message_id')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function view_chat(Request $request)
    {
        try {
            $thread = Thread::findOrFail($request->input('message_id'));
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: '.$request->input('message_id').' was not found.');

            return redirect('messages');
        }


        if ($request->post("is_first_load") == "1") {
            // don't show the current user in list
            $userId = Auth::user()->id;
            $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

            $thread->markAsRead($userId);

            $messages = [];
            $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(5);

            return response()->json(['success' => true, 'data' => view('messenges.chat.message_title')->with('thread',$thread)->render(), 'message_id' => $request->input('message_id')]);
        }



    }

    /**
     * @param $user
     * @return string
     */
    protected function getFotoEmpleado($user)
    {
        return isset($user->photo) ?  asset('storage/jornal/usuario/'.  $user->id. '/perfil/' . $user->photo . '') : asset('img/avatar5.png');
    }


    /**
     * @param $data
     * @param string $mode
     * @param bool $return_only_message
     * @param bool $online_status
     * @return array|string
     */
    private function _make_row($data, $mode = "", $return_only_message = false, $online_status = false) {

        $image_url = $this->getFotoEmpleado($data->user);
        $username = $data->user->username;
        $created_at = Carbon::parse($data->created_at)->diffForHumans();
        $message_id = $data->id;
        $label = "";
        $reply = "";
        $status = $data->isUnread($data->user->id) ? 'alert-info' : '';
        $attachment_icon = "";
        $subject = $data->subject;

        if ($data->subject) {
            $label = " <label class='label label-success inline-block'>Responder</label>";
            $reply = "1";
            $subject = $data->subject;
        }

        /*if ($data->files && count(unserialize($data->files))) {
            $attachment_icon = "<i class='fa fa-paperclip font-16 mr15'></i>";
        }*/


        //prepare online status


        $message = "<div class='pull-left message-row $status' data-id='$message_id' data-index='$message_id' data-reply='$reply'><div class='media-left'>
                        <span class='avatar avatar-xs'>
                            <img src='$image_url' />

                        </span>
                    </div>
                    <div class='media-body'>
                        <div class='media-heading'>
                            <strong> $username </strong>
                                  <span class='text-off pull-right time'>$attachment_icon $created_at</span>
                        </div>
                        $label $subject
                    </div></div>

                ";
        if ($return_only_message) {
            return $message;
        } else {
            return array(
                $message,
                Carbon::parse($data->created_at)->format('Y-m-d h:i:s A')
            );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateFiles(Request $request)
    {
        $file = $request->post('file_name');

        if(!is_null($file)) {
            $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $file_formates = explode(",", "jpg,jpeg,doc,png");
            if (in_array($file_ext, $file_formates)) {
                return response()->json(['success' => true]);
            }

        }
    }

    /**
     * @param Request $request
     */
    public function uploadFiles(Request $request)
    {
        $this->validate($request, ['file.0' => 'required|mimes:png,gif,jpeg,jpg,bmp']);

        $file = $request->file('file.0');

        if(!is_null($file)) {
            $extension = strtolower(Input::file('file.0')->getClientOriginalExtension());
            $filePath      = $file->getRealPath();
            $fileName = $file->getClientOriginalName().'.'.$extension;
            $file->move(storage_path('app/public/messages/'. $request->post('message_id')) .'/user/' . auth()->user()->id . '/', $fileName);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function chatList(Request $request)
    {
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();
        return response()->json(['success' => true, 'data' => view('messenges.chat.chat_list')->with('threads',$threads)->render()]);
        //return view('messenges.chat.chat_list', compact('threads'));
    }

}
