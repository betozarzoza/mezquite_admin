<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debt;
use App\Models\User;
use App\Models\Activity;
use DB;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function add_general_debt () {
        $page_title = 'Crear Deuda General';
        $page_description = 'Formulario para crear deuda general';
        $action = __FUNCTION__;
        return view('zenix.form.add_general_debt', compact('page_title', 'page_description', 'action'));
    }

    public function create_general_debt (Request $request) {
        $this->validate($request, [
            'motivo' => 'required',
            'cantidad' => 'required',
        ]);

        $users = User::all();
        foreach ($users as $user) {
            $debt = new Debt;
            $debt->user_id = $user->id;
            $debt->name = $request->motivo;
            $debt->type = 'general';
            $debt->quantity = $request->cantidad;
            $debt->status = 'unpaid';
            $debt->save();
        }
        $activity = new Activity;
        $activity->name = 'Se agrego el adeudo general de '.$request->motivo.' por la cantidad de $'.$request->cantidad ;
        $activity->status = 5;
        $activity->save();
        return redirect('/');
    }

    public function add_payment_for_debt (Request $request) {
        $page_title = 'Agregar pago de deuda';
        $page_description = 'Formulario para crear un pago de una deuda';
        $action = __FUNCTION__;
        $user_id = $request->user_id;
        $debts = Debt::where([['user_id', $user_id],['status', 'unpaid']])->get();
        return view('zenix.form.add_payment_for_debt', compact('page_title', 'page_description', 'action', 'user_id', 'debts'));
    }
}
