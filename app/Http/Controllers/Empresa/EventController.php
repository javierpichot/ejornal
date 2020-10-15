<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 03/12/18
 * Time: 09:49 AM
 */

namespace App\Http\Controllers\Empresa;


use App\Models\Ausentismo;
use App\Models\Empresa;
use App\Models\Event;
use App\Traits\CheckEmpresaTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * Class EventController
 * @package App\Http\Controllers\Empresa
 */
class EventController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * [protected description]
     * @var [type]
     */
    protected $model;
    /**
     * [__construct description]
     * @param Event $event [description]
     */
    public function __construct(Event $event)
    {
        $this->middleware('auth');
        $this->model = $event;
    }
    /**
     * [index description]
     * @param  [type] $id_empresa [description]
     * @param  [type] $name       [description]
     * @return [type]             [description]
     */
    public function index($id_empresa, $name)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::findOrFail($id_empresa);

        return view('backend.calendario.index', compact('empresa'));
    }
    /**
     * [modal_form description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function modal_form(Request $request)
    {
        $this->checkEmpresa($request->post('client_id'));
        $empresa = Empresa::findOrFail($request->post('client_id'));
        $users_empresa = json_encode($this->_make_users_empresa($empresa));
        return view('events.modal_event', compact('empresa', 'users_empresa'));
    }


    /**
     * @param $data
     * @return array
     */
    private function _make_users_empresa($data) {

        $members_and_teams_dropdown = array();

        foreach ($data->users as $member) {
            $members_and_teams_dropdown[] = array("type" => "member", "id" => "member:" . $member->id, "text" => $member->nombre . " " . $member->apellido);
        }

        return $members_and_teams_dropdown;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $encrypted_event_id =  Crypt::decrypt($request->post('encrypted_event_id'));



        $new_status = "";
        $old_status = "";
        $user_id = auth()->user()->id;

        if ($request->post('status') == "confirmed") {
            $new_status .= "confirmed_by";
            $old_status .= "rejected_by";
        } else if ($request->post('status') == "rejected") {
            $new_status .= "rejected_by";
            $old_status .= "confirmed_by";
        }


        $sql = "UPDATE events SET $new_status = CONCAT($new_status,',',$user_id), $old_status = REPLACE($old_status,',$user_id','')
                WHERE events.id=$encrypted_event_id AND FIND_IN_SET($user_id,$new_status) = 0";

        DB::update($sql);

        $model_info = $this->_make_view_data($encrypted_event_id);

        return view('events.view_event', compact('model_info'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'color' => 'required',
            'empresa_id' => 'required'
        ]);

        $this->checkEmpresa($request->post('empresa_id'));
        $empresa = Empresa::findOrFail($request->post('empresa_id'));

        //prepare share with data
        $share_with = $request->post('share_with');
        if ($share_with == "specific") {
            $share_with = $request->post('share_with_specific');
        } else if ($share_with == "specific_client_contacts") {
            $share_with =$request->post('share_with_specific_client_contact');
        }

        if ( $request->has('start_time') or $request->has('end_time') ) {
            $start_time = Carbon::now();
            $end_time = Carbon::now();
        }

        $data = array(
            "title" => $request->post('title'),
            "description" => $request->post('description'),
            "start_date" => $request->post('start_date'),
            "end_date" => $request->post('end_date'),
            "start_time" => $start_time->format('h:i:s A'),
            "end_time" => $end_time->format('h:i:s A'),
            "location" => $request->post('location'),
            "labels" => $request->post('labels'),
            "color" => $request->post('color'),
            "user_id" => auth()->user()->id,
            "empresa_id" => $request->post('empresa_id'),
            "share_with" => $share_with,
            "repeat_type" => NULL,
            "no_of_cycles" => 0
        );

        if (Event::create($data)){
            return response()->json([
                'fail' => false,
                'text' => 'Evento creado exitosamente..!',
                'redirect_url' => route('calendario.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        } else {
            return response()->json([
                'fail' => true,
                'text' => 'Hubo un error, intentalo nuevamente..!',
                'redirect_url' => route('calendario.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $encrypted_event_id =  Crypt::decrypt($request->post('encrypted_event_id'));
        $empresa_id = $request->post('empresa_id');
        $this->checkEmpresa($empresa_id);

        $event = Event::findOrFail($encrypted_event_id);

        if ($event->delete()){
            return response()->json(["success" => true, "message" => "El evento ha sido eliminado..!"]);
        } else {
            return response()->json(["success" => false, "message" => "Hubo un error, intentalo nuevamente"]);
        }

    }
    /**
     * [view description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function view(Request $request)
    {
        $encrypted_event_id =  Crypt::decrypt($request->post('id'));
        $cycle = $request->post('cycle');

        $model_info = $this->_make_view_data($encrypted_event_id, $cycle);

        return view('events.view_event', compact('model_info'));
    }
    /**
     * [_make_view_data description]
     * @param  [type] $encrypted_event_id [description]
     * @param  string $cycle              [description]
     * @return [type]                     [description]
     */
    private function _make_view_data($encrypted_event_id, $cycle = "0") {
        $user_id = auth()->user()->id;

        $where = " (user_id=$user_id
                OR share_with='all'
                    OR (FIND_IN_SET('member:$user_id', share_with)))";
        $model_info = $this->model->with(['user'])
            ->whereRaw($where)
            ->findOrFail($encrypted_event_id);
        if ($encrypted_event_id && $model_info->id) {

            if ($model_info->recurring && $cycle) {
                $model_info->start_date =  $this->add_period_to_date($model_info->start_date, $model_info->repeat_every * $cycle, $model_info->repeat_type);
                $model_info->end_date =  $this->add_period_to_date($model_info->end_date, $model_info->repeat_every * $cycle, $model_info->repeat_type);
            }

            $view_data['encrypted_event_id'] = Crypt::encrypt($encrypted_event_id); //to make is secure we'll use the encrypted id
            $view_data['model_info'] = $model_info;
            $view_data['event_icon'] = $this->get_event_icon($model_info->share_with);


            $confirmed_by_array = explode(",", $model_info->confirmed_by);
            $rejected_by_array = explode(",", $model_info->rejected_by);


            $event_labels = "";
            if ($model_info->labels) {
                $labels = explode(",", $model_info->labels);
                foreach ($labels as $label) {
                    $event_labels .= "<span class='label large' style='background-color:$model_info->color;' title='Etiqueta'>" . $label . "</span> ";
                }
            }
            $view_data['labels'] = $event_labels;
            //prepare status lable and status buttons
            $status = "";
            $status_button = "";


            $status_confirm = '<a href="#" class="btn btn-success pull-left" data-post-encrypted_event_id="'.Crypt::encrypt($encrypted_event_id).'" title="Detalles de evento" data-post-status="confirmed" data-post-editable="1" data-act="ajax-modal" data-title="Detalles de evento" data-action-url="'. route('events.update') .'"> <i class="fa fa-check-circle-o"></i> Confirmar</a>';

            $status_reject = '<a href="#" class="btn btn-danger pull-left" data-post-encrypted_event_id="'.Crypt::encrypt($encrypted_event_id).'" title="Detalles de evento" data-post-status="rejected" data-post-editable="1" data-act="ajax-modal" data-title="Detalles de evento" data-action-url="'. route('events.update') .'"> <i class="fa fa-times-circle-o"></i> Rechazar</a>';

            if (in_array(auth()->user()->id, $confirmed_by_array)) {
                $status = "<span class='label large' style='background-color:#5CB85C;' title='Event status'>confirmed</span> ";
                $status_button = $status_reject;
            } else if (in_array(auth()->user()->id, $rejected_by_array)) {
                $status = "<span class='label large' style='background-color:#D9534F;' title='Event status'>rejected</span> ";
                $status_button = $status_confirm;
            } else {
                $status_button = $status_confirm . $status_reject;
            }

            $view_data["status"] = $status;
            $view_data['status_button'] = $status_button;

            //prepare confimed/rejected user's list
            $confimed_rejected_users = $this->_get_confirmed_and_rejected_users_list($confirmed_by_array, $rejected_by_array);


            $view_data['confirmed_by'] = $this->get_array_value($confimed_rejected_users, 'confirmed_by');
            $view_data['rejected_by'] =  $this->get_array_value($confimed_rejected_users, 'rejected_by');


            return $view_data;
        }



    }
    /**
     * [get_array_value description]
     * @param  array  $array [description]
     * @param  [type] $key   [description]
     * @return [type]        [description]
     */
    protected function get_array_value(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }
    /**
     * [getFotoEmpleado description]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    protected function getFotoEmpleado($user)
    {
        return isset($user->photo) ?  asset('storage/jornal/usuario/'.  $user->id. '/perfil/' . $user->photo . '') : asset('img/avatar5.png');
    }
    /**
     * [_get_confirmed_and_rejected_users_list description]
     * @param  [type] $confirmed_by_array [description]
     * @param  [type] $rejected_by_array  [description]
     * @return [type]                     [description]
     */
    private function _get_confirmed_and_rejected_users_list($confirmed_by_array, $rejected_by_array) {

        $confirmed_by = "";
        $rejected_by = "";

        $response_by_users = $this->get_response_by_users($confirmed_by_array, $rejected_by_array);

        if ($response_by_users) {
            foreach ($response_by_users as $key => $row) {
                $photo = $this->getFotoEmpleado($row);

                $response_by_user = "<span data-toggle='tooltip' title='" . $row->nombre . " " . $row->apellido . "' class='avatar avatar-xs mr10'><img src='$photo' alt='...'></span>";

                if (in_array($row->id, $confirmed_by_array)) {
                    $confirmed_by .= $response_by_user;
                } else {
                    $rejected_by .= $response_by_user;
                }
            }
        }


        return array("confirmed_by" => $confirmed_by, "rejected_by" => $rejected_by);
    }

    /**
     * @param $confirmed_by_array
     * @param $rejected_by_array
     * @return bool|\Illuminate\Support\Collection
     */
    private function get_response_by_users($confirmed_by_array, $rejected_by_array) {

        $user_ids_confirmed = implode(",", $confirmed_by_array);
        $user_ids_rejected = implode(",", $rejected_by_array);

        if ($user_ids_confirmed && $user_ids_rejected) {
            $where = " (FIND_IN_SET(id, '$user_ids_confirmed')) OR (FIND_IN_SET(id, '$user_ids_rejected'))";

            $users = DB::table('users')
                        ->whereRaw($where)
                        ->get();
            return $users;
        } else {
            return false;
        }
    }
    /**
     * [show description]
     * @param  [type] $id_empresa [description]
     * @return [type]             [description]
     */
    public function show($id_empresa)
    {
        $start = \request()->get('start');
        $end = \request()->get('end');
        $user_id = auth()->user()->id;
        $where = "";
        $result = array();
        $where = " (user_id=$user_id
                OR share_with='all'
                    OR (FIND_IN_SET('member:$user_id', share_with)))";

        $list_data_of_events = $this->model
                        ->where('empresa_id', $id_empresa)
                        ->where('start_date', '>=', $start)
                        ->where('end_date', '<=', $end)
                        ->whereRaw($where)
                        ->get();

        foreach ($list_data_of_events as $data) {
            $data->cycle = 0;
            $result[] = $this->_make_calendar_event($data);
            if ($data->recurring) {
                $no_of_cycles = $this->get_no_of_cycles($data->repeat_type, $data->no_of_cycles);

                for ($i = 1; $i <= $no_of_cycles; $i++) {
                    $data->start_date = $this->add_period_to_date($data->start_date, $data->repeat_every, $data->repeat_type);
                    $data->end_date = $this->add_period_to_date($data->end_date, $data->repeat_every, $data->repeat_type);
                    $data->cycle = $i;

                    $result[] = $this->_make_calendar_event($data);
                }
            }
        }

        return response()->json($result);

    }
    /**
     * [_make_leave_event description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function _make_leave_event($data) {
        if ($data->fecha_alta == null){
            $fecha_alta = Carbon::now()->format('Y-m-d');
        } else {
            $fecha_alta = $data->fecha_alta;
        }
        return array(
            "title" => "" .$data->trabajador->nombre . " " .$data->trabajador->apellido. " por ".  $data->motivo,
            "icon" => "fa fa-sign-out",
            "start" => $data->fecha_ausente . " 00:00:00",
            "end" => $fecha_alta . " 00:00:00",
            "encrypted_event_id" => Crypt::encrypt($data->id), //to make is secure we'll use the encrypted id
            "borderColor" => "#f012be",
            "backgroundColor" => "#f012be",
            "cycle" => 0,
            "event_type" => "leave"
        );
    }
    /**
     * [get_no_of_cycles description]
     * @param  [type]  $repeat_type  [description]
     * @param  integer $no_of_cycles [description]
     * @return [type]                [description]
     */
    protected function get_no_of_cycles($repeat_type, $no_of_cycles = 0) {
        if ($repeat_type === "days") {
            //for days type repeating, max value can't be more then 365 days
            if (!$no_of_cycles || $no_of_cycles > 365) {
                $no_of_cycles = 365;
            }
        } else if ($repeat_type === "weeks") {
            //for weeks type repeating, max value can't be more then 520 weeks
            if (!$no_of_cycles || $no_of_cycles > 520) {
                $no_of_cycles = 520;
            }
        } else if ($repeat_type === "months") {
            //for months type repeating, max value can't be more then 120 monts
            if (!$no_of_cycles || $no_of_cycles > 120) {
                $no_of_cycles = 120;
            }
        } else if ($repeat_type === "years") {
            //for days type years, max value can't be more then 10 years
            if (!$no_of_cycles || $no_of_cycles > 10) {
                $no_of_cycles = 10;
            }
        }

        return $no_of_cycles;
    }
    /**
     * [add_period_to_date description]
     * @param [type]  $date        [description]
     * @param integer $no_of       [description]
     * @param string  $period_type [description]
     */
    protected  function add_period_to_date($date, $no_of = 0, $period_type = "days") {
        return date('Y-m-d', strtotime("+$no_of $period_type", strtotime($date)));
    }
    /**
     * [_make_calendar_event description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function _make_calendar_event($data) {

        return array(
            "title" => $data->title,
            "icon" => $this->get_event_icon($data->share_with),
            "start" => $data->start_date . " " . $data->start_time,
            "end" => $data->end_date . " " . $data->end_time,
            "encrypted_event_id" => Crypt::encrypt($data->id), //to make is secure we'll use the encrypted id
            "backgroundColor" => $data->color,
            "borderColor" => $data->color,
            "cycle" => $data->cycle,
            "event_type" => "event"
        );
    }
    /**
     * [get_event_icon description]
     * @param  string $share_with [description]
     * @return [type]             [description]
     */
    protected function get_event_icon($share_with = "") {
        $icon = "";
        if (!$share_with) {
            $icon = "fa-lock";
        } else if ($share_with == "all") {
            $icon = "fa-globe";
        } else {
            $icon = "fa-at";
        }
        return $icon;
    }

}
