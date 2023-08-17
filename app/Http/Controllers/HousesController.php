<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Houses;
use DB;

class HousesController extends Controller
{
    public function show_houses () {
        $page_title = 'Lista de casas';
        $page_description = 'Muestra la lista de las casas';
        $action = __FUNCTION__;
        $houses = Houses::get();
        return view('zenix.user.houses', compact('page_title', 'page_description', 'action', 'houses'));
    }

    public function addMontlyPaymentToHouses () {
        DB::table('houses')->increment('balance', 700);
    }

    public function add_extra_payment (Request $request) {
        DB::table('houses')->decrement('balance', $request->cantidad);
        return redirect('/');
    }

    public function add_extra () {
        $page_title = 'Crear Pago Extraordinario';
        $page_description = 'Crear pago extraordinario';
        $action = __FUNCTION__;
        return view('zenix.form.add_extra_payment', compact('page_title', 'page_description', 'action'));
    }

    public function inactive_houses () {
        Houses::where('balance', '>', 0)->update(['active' => 0]);
    }
}
