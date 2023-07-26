<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $movement = new Movement;
 
        $movement->name = $request->nombre;
        $movement->quantity = $request->cantidad;
        $movement->type = $request->tipo;
        $movement->addressat = $request->destinatario;
        $movement->month = $request->mes;
        $movement->note = $request->nota;
        $movement->created_by = $id;
 
        $movement->save();

        $this->modifyBalance($request->cantidad, $request->tipo);
 
        return redirect('/movements');
    }

    public function show_movements () {
        $page_title = 'Movimientos';
        $page_description = 'Muestra los ingresos y egresos';
        $action = __FUNCTION__;
        $movements = Movement::with('user')->get();
        return view('zenix.dashboard.movements', compact('page_title', 'page_description', 'action', 'movements'));
    }

    public function show_movements_filtered (Request $request) {
        $filter = $request->filter;
        $page_title = 'Movimientos';
        $page_description = 'Muestra los ingresos y egresos';
        $action = __FUNCTION__;
        if (count($filter) > 0) {
            $movements = Movement::with('user')->whereIn('addressat', $filter)->get();
        } else {
            $movements = Movement::with('user')->get();
        }
        return view('zenix.dashboard.movements', compact('page_title', 'page_description', 'action', 'movements'));
    }

    public function modifyBalance($quantity, $operation) {
        $balance = General::where('name', 'balance')->value('value');
        if ($operation == 'ingreso') {
            $balance = $balance + $quantity;
        } else if ($operation == 'egreso') {
            $balance = $balance - $quantity;
        }
        $affected = General::where('name', 'balance')->update(['value' => $balance]);
    }
}
