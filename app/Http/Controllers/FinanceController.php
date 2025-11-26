<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debt;
use App\Models\User;
use App\Models\Houses;
use App\Models\General;
use App\Models\Movement;
use App\Models\Activity;
use DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Mailgun\Mailgun;
use App\Mail\Receipt;
//use Illuminate\Support\Facades\Mail;
use Mail;


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
            $user = User::find($user->id)->house;
            $debt = new Debt;
            if ($user->balance > 0 && $user->balance > $request->cantidad) {
                $debt->status = 'paid';
                $house = Houses::find($user->id);
                $house->balance = $house->balance - $request->cantidad;
                $house->save();
                $debt->quantity = $request->cantidad;

            } else if ($user->balance > 0 && $user->balance < $request->cantidad) {
                $debt->status = 'unpaid';
                $debt->quantity = $request->cantidad - $user->balance;
                $house = Houses::find($user->id);
                $house->balance = 0;
                $house->save();
            } else {
                $debt->status = 'unpaid';
                $debt->quantity = $request->cantidad;
            }
            $debt->user_id = $user->id;
            $debt->name = $request->motivo;
            $debt->type = 'general';
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
        $my_debt = Debt::where('status', 'unpaid')->where('user_id', $user_id)->sum('quantity');
        return view('zenix.form.add_payment_for_debt', compact('page_title', 'page_description', 'action', 'user_id', 'debts', 'my_debt'));
    }

    public function create_payment_for_debt (Request $request) {
        //Update the debt table
        $debt = Debt::find($request->debt);
        $debt->status = 'paid';
        $debt->save();
        //modify general balance
        $this->modifyGeneralBalance($debt->quantity, 'ingreso');

        //send receipt to email -to-do whatsapp
        $mg = Mailgun::create(getenv('API_KEY') ?: 'API_KEY');

        $user = User::find($debt->user_id);
        Mail::to($user->email)->send(new Receipt($user, $debt));

        //Add Activity
        $activity = new Activity;
        $activity->name = 'Pago de '.$debt->name.'por casa '.$debt->user_id;
        $activity->status = 1;
        $activity->save();

        $movement = new Movement;
        $movement->name = 'Pago de mantenimiento casa '.$request->destinatario.' del mes de '.$mes;
        $movement->quantity = $debt->quantity;
        $movement->type = 'ingreso';
        $movement->addressat = $request->destinatario;
        //$movement->month = $mes;
        $movement->year = $request->year;
        $movement->note = $request->nota;
        $movement->created_by = $id;
        $movement->last_balance = General::where('name', 'balance')->value('value');
        $movement->save();
        return redirect('/');
    }

    public function add_payment_for_debt_step_1 (Request $request) {
        $page_title = 'Agregar pago de deuda paso 1';
        $page_description = 'Formulario para crear un pago de una deuda';
        $action = __FUNCTION__;
        return view('zenix.form.add_payment_for_debt_step_1', compact('page_title', 'page_description', 'action'));
    }

    public function redirect_payment_for_debt_to_next_step (Request $request) {
        return redirect('/add_payment_for_debt/'.$request->destinatario);
    }

    public function modifyGeneralBalance($quantity, $operation) {
        $balance = General::where('name', 'balance')->value('value');
        if ($operation == 'ingreso') {
            $balance = $balance + $quantity;
        } else if ($operation == 'egreso') {
            $balance = $balance - $quantity;
        }
        $affected = General::where('name', 'balance')->update(['value' => $balance]);
    }
}
