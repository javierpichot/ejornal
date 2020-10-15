<?php

namespace App\Http\Controllers\Empresa;
use App\Mail\Upload;
use App\Models\Empresa;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Client;


/**
 * Class WebMailController
 * @package App\Http\Controllers\Empresa
 */
class WebMailController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * @param $empresa_id
     * @param $name
     * @param $folder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     * @throws \Webklex\IMAP\Exceptions\GetMessagesFailedException
     */
    public function index($empresa_id, $name, $folder)
    {
        $rol=auth()->user()->getRoleSlug();
        $cuenta=$rol.strtolower($name)."@ejornal.com.ar";
        $pass=$rol.strtolower($name);
        $oClient = new Client([
            'host'          => 'ejornal.com.ar',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => $cuenta,
            'password'      => $pass,
            'protocol'      => 'imap'
        ]);
        //Connect to the IMAP Server
        $oClient->connect();
        $aFolders = $oClient->getFolders();
        $oFolder = $oClient->getFolder($folder);
        $messages = $oFolder->messages()->all()->get()->paginate();


        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        return view('web_mail.mailbox', compact('empresa', 'aFolders', 'messages', 'folder'));
    }

    /**
     * @param $empresa_id
     * @param $name
     * @param $folder
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     * @throws \Webklex\IMAP\Exceptions\GetMessagesFailedException
     * @throws \Webklex\IMAP\Exceptions\InvalidWhereQueryCriteriaException
     * @throws \Webklex\IMAP\Exceptions\MessageSearchValidationException
     */
    public function show($empresa_id, $name, $folder, $id)
    {
        $rol=auth()->user()->getRoleSlug();
        $cuenta=$rol.strtolower($name)."@ejornal.com.ar";
        $pass=$rol.strtolower($name);

        $oClient = new Client([
            'host'          => 'ejornal.com.ar',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => $cuenta,
            'password'      => $pass,
            'protocol'      => 'imap'
        ]);
        //Connect to the IMAP Server
        $oClient->connect();
        $aFolders = $oClient->getFolders();
        $oFolder = $oClient->getFolder($folder);
        $oFolder->query()->markAsRead();
        $oMessage = $oFolder->getMessage($id, null, null, true, true);

        $aAttachment = $oMessage->getAttachments();

        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        $dir = storage_path('app/public/empresas/'. $empresa->id. '/adjuntos/');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return view('web_mail.read_mail', compact('empresa', 'aFolders', 'oMessage', 'folder', 'aAttachment'));
    }

    /**
     * @param $empresa_id
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($empresa_id, $name)
    {
        $rol=auth()->user()->getRoleSlug();
        $cuenta=$rol.strtolower($name)."@ejornal.com.ar";
        $pass=$rol.strtolower($name);

        $oClient = new Client([
            'host'          => 'ejornal.com.ar',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => $cuenta,
            'password'      => $pass,
            'protocol'      => 'imap'
        ]);
        //Connect to the IMAP Server
        $oClient->connect();
        $aFolders = $oClient->getFolders();
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        return view('web_mail.create', compact('aFolders', 'empresa'));
    }

    /**
     * @param Request $request
     * @param $empresa_id
     * @param $nombre
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $empresa_id, $nombre)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $emails = $request->post('to');
        $subject =  $request->post('subject');
        $message = $request->post('message');
        $files = $request->file('files');

        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'files' => 'mimes:jpeg,bmp,png,pbm,flv,mp4,mpg',
        ]);
        $rol=auth()->user()->getRoleSlug();
        $de=$rol.strtolower($nombre)."@ejornal.com.ar";
        $attachments = [];
        try
        {
            if ($request->has('files')) {
                foreach ($files as $i => $file ) //Adjuntamos los archivos en un array
                {
                    $attachments[] = [
                        'file' => $file->getRealPath(),
                        'options' => [
                            'mime' => $file->getClientMimeType(),
                            'as'    => $file->getClientOriginalName()
                        ]
                    ];
                }
            }

            foreach (explode(',',  $emails) as $key => $email) {
                Mail::to($emails)->send(new Upload($attachments, $subject, $empresa, $message, $de));
            }

            return redirect()->route('empresa.mails.index', ['id' => $empresa->id, 'nombre' => $empresa->nombre, 'folder' => 'inbox']);
        }
        catch (\Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 401);
        }
    }

    /**
     * @param Request $request
     * @param $empresa_id
     * @param $name
     * @param $folder
     * @param $id
     * @return JsonResponse
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     * @throws \Webklex\IMAP\Exceptions\GetMessagesFailedException
     * @throws \Webklex\IMAP\Exceptions\InvalidWhereQueryCriteriaException
     * @throws \Webklex\IMAP\Exceptions\MessageSearchValidationException
     */
    public function destroy(Request $request, $empresa_id, $name, $folder, $id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $rol=auth()->user()->getRoleSlug();
        $cuenta=$rol.strtolower($name)."@ejornal.com.ar";
        $pass=$rol.strtolower($name);

        $oClient = new Client([
            'host'          => 'ejornal.com.ar',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => $cuenta,
            'password'      => $pass,
            'protocol'      => 'imap'
        ]);
        //Connect to the IMAP Server
        $oClient->connect();
        $aFolders = $oClient->getFolders();
        $oFolder = $oClient->getFolder($folder);

        if( $oFolder->getMessage($request->post('message_id'))->delete() ) {
            $response = [
                'redirect_url' => route('empresa.mails.index', ['id' => $empresa_id, 'name' => $empresa->nombre, 'folder' => $folder]),
                'status'    =>  'success',
                'message'   =>  'Registro eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intente nuevamente'
            ];
        }

        if( \request()->ajax() ) {
            return new JsonResponse($response);
        } else {

        }
    }
}
