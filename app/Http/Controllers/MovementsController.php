<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Movement;
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

    public function create_movement(Request $request) {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'cantidad' => 'required',
            'tipo' => 'required',
            'destinatario' => 'required',
            'mes' => 'required'
        ]);
        $id = Auth::id();

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

        $this->modifyGeneralBalance($request->cantidad, $request->tipo);
        $this->checkIfInactiveAndActivateIt($request->cantidad, $request->tipo, $request->destinatario);
 
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
            $house->last_payment = $last_payment;
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
