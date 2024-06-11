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
        $activities = Activity::orderBy('created_at')->take(10)->get();
        $surveys = Survey::where('active', 1)->get();
        $id = Auth::id();
        $user = User::find($id)->house;

        return view('zenix.dashboard.index', compact('page_title', 'page_description', 'action', 'balance', 'ingresos', 'egresos', 'houses', 'user', 'notifications', 'surveys', 'activities'));

    }

    public function open_gate(){
        $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=f6fee870-5658-41c4-8b11-fe795f8298a9&token=bef983a5-596d-4d67-9eee-6f965f66e33b&response=json');
        //print_r($response->json());
        $response = $response->json();
        if (count($response) > 0 && $response['URLRoutineTrigger']['triggerActivationStatus'] == 'success') {
            return redirect('/index');
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
        $checkin->type = 'comida';
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
