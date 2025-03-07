<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Houses;
use App\Models\User;
use App\Models\Activity;
use DB;
use Illuminate\Support\Facades\Auth;

class HousesController extends Controller
{
    public function show_houses () {
        $page_title = 'Lista de casas';
        $page_description = 'Muestra la lista de las casas';
        $action = __FUNCTION__;
        $houses = Houses::get();
        return view('zenix.user.houses', compact('page_title', 'page_description', 'action', 'houses'));
    }

    public function show_houses_guard () {
        $page_title = 'Lista de casas';
        $page_description = 'Muestra la lista de las casas';
        $action = __FUNCTION__;
        $houses = Houses::get();
        return view('zenix.user.houses_guard', compact('page_title', 'page_description', 'action', 'houses'));
    }

    public function addMontlyPaymentToHouses () {
        DB::table('houses')->increment('balance', 700);
    }

    public function profile_update(Request $request) {
        $id = Auth::id();
        $user = User::find($id);
        $house = Houses::find($user->houses_id);
        $house->owner_name = $request->nombre_del_propietario;
        $house->owner_contact = $request->telefono;
        $house->color = $request->color;
        $house->save();
        return redirect('/app-profile');
    }

    public function add_extra_payment (Request $request) {
        $this->validate($request, [
            'motivo' => 'required',
            'cantidad' => 'required',
        ]);

        DB::table('houses')->increment('balance', $request->cantidad);

        $activity = new Activity;
        $activity->name = 'Se agrego el pago general de '.$request->motivo.' por la cantidad de $'.$request->cantidad ;
        $activity->status = 2;
        $activity->save();
        return redirect('/');
    }

    public function add_extra () {
        $page_title = 'Crear Pago General';
        $page_description = 'Crear pago general';
        $action = __FUNCTION__;
        return view('zenix.form.add_extra_payment', compact('page_title', 'page_description', 'action'));
    }

    public function inactive_houses () {
        Houses::where('balance', '>', 0)->update(['active' => 0]);
    }
}
