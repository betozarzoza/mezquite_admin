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
use App\Models\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $notifications = Notification::where('active', 1)->get();
        $activities = Activity::orderBy('created_at', 'DESC')->take(10)->get();
        $surveys = Survey::where('active', 1)->get();
        $arrived_at = Checkin::where('type', 'entrada')->whereDate('created_at', Carbon::today())->get();
        $leaved_at = Checkin::where('type', 'salida')->whereDate('created_at', Carbon::today())->get();
        $lunch = Checkin::where('type', 'sali a comer')->whereDate('created_at', Carbon::today())->get();
        $id = Auth::id();
        $user = User::find($id)->house;

        return view('zenix.dashboard.index', compact('page_title', 'page_description', 'action', 'balance', 'ingresos', 'egresos', 'houses', 'user', 'notifications', 'surveys', 'activities', 'arrived_at', 'leaved_at', 'lunch'));

    }

    public function open_gate(){
         $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=42e7af94-f973-41e9-adef-ec2a492eaff9&token=f945efa8-34d0-45e1-9458-92dd260b96ed&response=json');
        print_r($response->json());
        $response = $response->json();
        if (count($response) > 0 && $response['URLRoutineTrigger']['triggerActivationStatus'] == 'success') {
            //return redirect('/index');
        }
    }

    public function checkin(){
        $checkin = new Checkin;
        $checkin->type = 'entrada';
        $checkin->save();
        return redirect('/index');
    }

    public function checkout(){
        $checkin = new Checkin;
        $checkin->type = 'salida';
        $checkin->save();
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
        return view('zenix.app.user_profile', compact('page_title', 'page_description', 'action'));
    }

    public function add_activity () {
        $page_title = 'Agregar actividad';
        $page_description = 'agregar actividad';
        $action = __FUNCTION__;
        return view('zenix.form.add_activity', compact('page_title', 'page_description', 'action'));
    }

    public function create_activity(Request $request){
        foreach ($request->objetivo as $objetivo) {
            $activity = new Activity;
            if ($request->actividad !== 'otro') {
                $name = $request->actividad . ' casa ' . $objetivo;
            } else {
                 $name = $request->nota;
            }
            $activity->name = $name;
            $activity->status = 2;
            $activity->save();
            return redirect('/index');
        }
    }
}
