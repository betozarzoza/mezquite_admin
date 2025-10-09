<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Movement;
use App\Models\Houses;
use App\Models\User;
use App\Models\Activity;
use App\Models\Checkin;
use App\Models\Survey;
use App\Models\Guard;
use App\Models\Answer;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;

class GeneralController extends Controller
{
    // Dashboard
    public function show_index()
    {

        $page_title = 'Inicio';
        $page_description = 'Pagina principal';
        $action = __FUNCTION__;
        $balance = General::where('name', 'balance')->value('value');

        $ingresos = Movement::whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("-1 week")), date("Y-m-d H:i:s")])->where('type', 'ingreso')->sum('quantity');
        $egresos = Movement::whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("-1 week")), date("Y-m-d H:i:s")])->where('type', 'egreso')->sum('quantity');

        $houses = Houses::take(28)->get();
        $id = Auth::id();
        $user = User::find($id)->house;

        $notifications = Notification::where('active', 1)->get();
        $activities = Activity::orderBy('created_at', 'DESC')->take(10)->get();
        $surveys = Survey::where('active', 1)->get();
        foreach ($surveys as $survey){
            $survey->answered = count(Answer::where([['house_id', $user->id],['survey_id', $survey->id]])->get());
        }
        $arrived_at = Checkin::where('type', 'entrada')->whereDate('created_at', Carbon::today())->get();
        $leaved_at = Checkin::where('type', 'salida')->whereDate('created_at', Carbon::today())->get();
        $lunch = Checkin::where('type', 'sali a comer')->whereDate('created_at', Carbon::today())->get();

        return view('zenix.dashboard.index', compact('page_title', 'page_description', 'action', 'balance', 'ingresos', 'egresos', 'houses', 'user', 'notifications', 'surveys', 'activities', 'arrived_at', 'leaved_at', 'lunch'));

    }

    public function open_gate_animation(){
        $page_title = 'open_gate';
        $page_description = 'Abriendo porton';
        $action = __FUNCTION__;
        return view('zenix.app.open_gate_animation', compact('page_title', 'page_description', 'action'));
    }

    public function open_gate(){
        $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=42e7af94-f973-41e9-adef-ec2a492eaff9&token=f945efa8-34d0-45e1-9458-92dd260b96ed&response=html');
        return redirect('/open_gate_animation');
    }

    public function checkin(){
        $checkin = new Checkin;
        $checkin->type = 'entrada';
        $checkin->save();
        /*
        $notification_message = 'El guardia ha checado entrada';
        $client = new Client();
        $response = $client->request('POST', 'https://gate.whapi.cloud/messages/text', [
          'body' => '{
              "to": "5218341503463-1487997665@g.us",
              "body": "'.$notification_message.'"
            }',
          'headers' => [
            'Authorization' => 'Bearer '.$value = env('WHAPI_TOKEN', 'nothing'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
          ],
        ]);
        */
        return redirect('/index');
    }

    public function checkout(){
        $checkin = new Checkin;
        $checkin->type = 'salida';
        $checkin->save();
        /*
        $notification_message = 'El guardia ha checado salida';
        $client = new Client();
        $response = $client->request('POST', 'https://gate.whapi.cloud/messages/text', [
          'body' => '{
              "to": "5218341503463-1487997665@g.us",
              "body": "'.$notification_message.'"
            }',
          'headers' => [
            'Authorization' => 'Bearer '.$value = env('WHAPI_TOKEN', 'nothing'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
          ],
        ]);
        */
        return redirect('/index');
    }

    public function lunch(){
        $checkin = new Checkin;
        $checkin->type = 'sali a comer';
        $checkin->save();
        return redirect('/index');
    }

    public function lunchback(){
        $checkin = new Checkin;
        $checkin->type = 'regrese de comer';
        $checkin->save();
        return redirect('/index');
    }

    public function show_my_profile () {
        $page_title = 'Mi perfil';
        $page_description = 'Muestra mi perfil';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        $house = Houses::find($user->houses_id);
        return view('zenix.app.user_profile', compact('page_title', 'page_description', 'action', 'house'));
    }

    public function add_activity () {
        $page_title = 'Agregar actividad';
        $page_description = 'agregar actividad';
        $action = __FUNCTION__;
        return view('zenix.form.add_activity', compact('page_title', 'page_description', 'action'));
    }

    public function guard_activity () {
        $page_title = 'Vitacora del guardia';
        $page_description = 'vitacora';
        $action = __FUNCTION__;
        $guard_activities = Guard::orderBy('created_at', 'DESC')->take(20)->get();
        return view('zenix.dashboard.guard', compact('page_title', 'page_description', 'action', 'guard_activities'));
    }

    public function guard_checkins () {
        $page_title = 'Vitacora del guardia';
        $page_description = 'vitacora';
        $action = __FUNCTION__;
        $checkins = Checkin::orderBy('created_at', 'DESC')->take(20)->get();
        return view('zenix.dashboard.checkins', compact('page_title', 'page_description', 'action', 'checkins'));
    }

    public function create_activity(Request $request){
            $activity_guard = new Guard;
            $activity_guard->destiny = $request->objetivo;
            $activity_guard->activity = $request->actividad;
            $activity_guard->note = $request->nota;
            $activity_guard->status = 2;
            $activity_guard->save();

            $activity = new Activity;
            if ($request->actividad !== 'otro') {
                $name = $request->actividad . ' casa ' . $request->objetivo;
            } else {
                 $name = $request->nota;
            }
            $activity->name = $name;
            $activity->status = 2;
            $activity->save();
            return redirect('/guard_activity');
    }
}
