<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VisitorsController extends Controller
{
    public function add_visitor() {

        $page_title = 'Agregar visitante';
        $page_description = 'Formulario para agregar visitante';
        $action = __FUNCTION__;
        return view('zenix.form.add_visitor', compact('page_title', 'page_description', 'action'));

    }

    public function create_visitor(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'duracion' => 'required',
        ]);

        $id = Auth::id();
        $user = User::find($id);

        $visitor = new Visitor;
        $random_string = $this->generateRandomString(6);
        $visitor->name = $request->nombre;
        $visitor->active = 1;
        $visitor->duration = $request->duracion;
        $visitor->access_id = $random_string;
        $visitor->house_id = $user->houses_id;
 
        $visitor->save(); 
        return redirect('/my_guests');
    }

    public function visitor_access(Request $request) {
        $page_title = 'Visitante';
        $page_description = 'Acceso de visitante';
        $action = __FUNCTION__;
        $visitor = Visitor::where('access_id', $request->access_id)->get();
        $name = count($visitor) ? $visitor[0]['name'] : 'visitante';
        return view('zenix.app.visitor_access', compact('page_title', 'page_description', 'action', 'visitor'));
    }

    public function visitor_access_user(Request $request) {
        $page_title = 'Visitante';
        $page_description = 'Acceso de visitante';
        $action = __FUNCTION__;
        $visitor = Visitor::where('access_id', $request->access_id)->get();
        $name = count($visitor) ? $visitor[0]['name'] : 'visitante';
        return view('zenix.app.visitor_access_user', compact('page_title', 'page_description', 'action', 'visitor'));
    }

    public function thank_you_visitor(Request $request) {
        $page_title = 'Gracias';
        $page_description = 'Gracias por visitar el condominio, bienvenido.';
        $action = __FUNCTION__;
        return view('zenix.app.thank_you_visitor', compact('page_title', 'page_description', 'action'));
    }

    public function my_guests(Request $request) {
        $page_title = 'Mis invitados';
        $page_description = 'Mis invitados';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        $my_guests = Visitor::where('house_id', $user->houses_id)->orderBy('created_at', 'DESC')->get();
        return view('zenix.app.my_guests', compact('page_title', 'page_description', 'action', 'my_guests'));
    }

    public function release_the_kraken(Request $request){
        $visitor = Visitor::where('access_id', $request->access_id)->get();

        if (count($visitor)) {
            $visitor_verification = Visitor::find($visitor[0]['id']);
            if ($visitor_verification->duration == '1_time' && $visitor_verification->active) {
                $visitor_verification->active = 0;
                $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=42e7af94-f973-41e9-adef-ec2a492eaff9&token=f945efa8-34d0-45e1-9458-92dd260b96ed&response=html');
                $response = $response->json();
                if (count($response) > 0 && $response['URLRoutineTrigger']['triggerActivationStatus'] == 'success') {
                    $visitor_verification->save();
                }
            }
        }
        return redirect('/thank_you_visitor');
        /*
        $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=f6fee870-5658-41c4-8b11-fe795f8298a9&token=bef983a5-596d-4d67-9eee-6f965f66e33b&response=json');
        $response = $response->json();
        if (count($response) > 0 && $response['URLRoutineTrigger']['triggerActivationStatus'] == 'success') {
            return redirect('/index');
        }
        */
        //return redirect('/index');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
