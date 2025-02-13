<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
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

        $visitor = new Visitor;
 
        $visitor->name = $request->nombre;
        $visitor->active = 1;
        $visitor->duration = $request->duracion;
        $visitor->access_id = $this->generateRandomString(6);
 
        $visitor->save(); 
        return redirect('/add_visitor');
    }

    public function visitor_access(Request $request) {
        $page_title = 'Visitante';
        $page_description = 'Acceso de visitante';
        $action = __FUNCTION__;
        $visitor = Visitor::where('access_id', $request->access_id)->get();
        $name = count($visitor) ? $visitor[0]['name'] : 'visitante';
        return view('zenix.app.visitor_access', compact('page_title', 'page_description', 'action', 'name'));
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
