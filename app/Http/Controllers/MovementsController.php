<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Movement;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Houses;

class MovementsController extends Controller
{
    public function add_movement() {

        $page_title = 'Agregar ingreso/egreso';
        $page_description = 'Formulario apra agregar movimientos';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        if ($user->is_admin) {
            return view('zenix.form.add_movement', compact('page_title', 'page_description', 'action'));
        } else {
            return redirect('/movements');
        }
    }

    public function add_maintenance_payment() {

        $page_title = 'Agregar pago de mantenimiento';
        $page_description = 'Formulario para agregar pago de mantenimiento';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        if ($user->is_admin) {
            return view('zenix.form.add_maintenance_payment', compact('page_title', 'page_description', 'action'));
        } else {
            return redirect('/movements');
        }
    }


    public function show_invoice(Request $request) {

        $page_title = 'Mostrar recibo';
        $page_description = 'Recibo de pago';
        $action = __FUNCTION__;
        $movement = Movement::with('user')->with('house')->find($request->movement_id);
        return view('zenix.ecommerce.invoice_mezquite', compact('page_title', 'page_description', 'action', 'movement'));

    }


    public function create_maintenance_payment (Request $request) {
        $id = Auth::id();
        $this->validate($request, [
            'mes' => 'required',
        ]);
        foreach ($request->mes as $mes) {
            $movement = new Movement;
            $movement->name = 'Pago de mantenimiento casa '.$request->destinatario.' del mes de '.$mes;
            $movement->quantity = '1000';
            $movement->type = 'ingreso';
            $movement->addressat = $request->destinatario;
            $movement->month = $mes;
            $movement->year = $request->year;
            $movement->note = $request->nota;
            $movement->created_by = $id;
            $movement->save();

            //$user = find($id);
            $house = Houses::find($request->destinatario);
            switch ($mes) {
                case 'Enero':
                    $house->ene = 1;
                    break;
                case 'Febrero':
                    $house->feb = 1;
                    break;
                case 'Marzo':
                    $house->mar = 1;
                    break;
                case 'Abril':
                    $house->abr = 1;
                    break;
                case 'Mayo':
                    $house->may = 1;
                    break;
                case 'Junio':
                    $house->jun = 1;
                    break;
                case 'Julio':
                    $house->jul = 1;
                    break;
                case 'Agosto':
                    $house->ago = 1;
                    break;
                case 'Septiembre':
                    $house->sep = 1;
                    break;
                case 'Octubre':
                    $house->oct = 1;
                    break;
                case 'Noviembre':
                    $house->nov = 1;
                    break;
                case 'Diciembre':
                    $house->dic = 1;
                    break;
            }
            $house->save();

            $activity = new Activity;
            $activity->name = 'Pago de mantenimiento casa '.$request->destinatario.' del mes de '.$mes;
            $activity->status = 1;
            $activity->save();

            $this->modifyMyBalanceAndLastPayment(1000, 'ingreso', $request->destinatario, $mes . ' '. $request->year);
        }
        return redirect('/index');
    }
    public function create_movement(Request $request) {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'cantidad' => 'required',
            'tipo' => 'required',
        ]);
        $id = Auth::id();

        if ($request->mes) {
            foreach ($request->mes as $mes) {
                $movement = new Movement;
                $movement->name = $request->nombre;
                $movement->quantity = $request->cantidad / count($request->mes);
                $movement->type = $request->tipo;
                $movement->addressat = $request->destinatario;
                $movement->month = $mes;
                $movement->year = $request->year;
                $movement->note = $request->nota;
                $movement->created_by = $id;
                $movement->save();

                $this->modifyMyBalanceAndLastPayment($request->cantidad / count($request->mes), $request->tipo, $request->destinatario, $mes . ' '. $request->year);
            }
        } else {
            $movement = new Movement;
            $movement->name = $request->nombre;
            $movement->quantity = $request->cantidad;
            $movement->type = $request->tipo;
            $movement->addressat = $request->destinatario;
            $movement->year = $request->year;
            $movement->note = $request->nota;
            $movement->created_by = $id;
            $movement->save();
    }

        $this->modifyGeneralBalance($request->cantidad, $request->tipo);
        $this->checkIfInactiveAndActivateIt($request->cantidad, $request->tipo, $request->destinatario);
 
        return redirect('/movements');
    }

    public function create_expense(Request $request) {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'cantidad' => 'required',
        ]);
        $id = Auth::id();

        $movement = new Movement;
        $movement->name = $request->nombre;
        $movement->quantity = $request->cantidad;
        $movement->type = 'egreso';
        $movement->note = $request->nota;
        $movement->created_by = $id;
        $movement->save();

        $this->modifyGeneralBalance($request->cantidad, 'egreso');

        $activity = new Activity;
        $activity->name = 'Se egreso la cantidad de '.$request->cantidad. ' por motivo de '.$request->nombre ;
        $activity->status = 3;
        $activity->save();

        return redirect('/movements');
    }

    public function show_movements () {
        $page_title = 'Movimientos';
        $page_description = 'Muestra los ingresos y egresos';
        $action = __FUNCTION__;
        $movements = Movement::with('user')->orderBy('created_at', 'desc')->get();
        return view('zenix.dashboard.movements', compact('page_title', 'page_description', 'action', 'movements'));
    }

    public function show_movements_filtered (Request $request) {
        $filter = $request->filter;
        $page_title = 'Movimientos';
        $page_description = 'Muestra los ingresos y egresos';
        $action = __FUNCTION__;
        if (count($filter) > 0) {
            $movements = Movement::with('user')->whereIn('addressat', $filter)->orderBy('created_at', 'desc')->get();
        } else {
            $movements = Movement::with('user')->orderBy('created_at', 'desc')->get();
        }
        return view('zenix.dashboard.movements', compact('page_title', 'page_description', 'action', 'movements'));
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

    public function modifyMyBalanceAndLastPayment($quantity, $operation, $house_id, $last_payment) {
        if ($operation == 'ingreso' && $house_id !== 0) {
            $house = Houses::find($house_id);
            $house->balance = $house->balance - $quantity;
            if (!str_contains($last_payment, 'Pago extraordinario')) {
                $house->last_payment = $last_payment;
            }
            $house->save();
        }
    }

    public function checkIfInactiveAndActivateIt ($quantity, $operation, $house_id) {
        if ($operation == 'ingreso' && $house_id !== 0) {
            $house = Houses::find($house_id);
            if ($house->active == 0) {
                if ($house->balance <= 0) {
                    $house->active = 1;
                    $house->save();
                }
            }
        }
    }
}
