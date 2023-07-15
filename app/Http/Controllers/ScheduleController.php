<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function add_schedule() {

        $page_title = 'Agregar ingreso/egreso';
        $page_description = 'Formulario apra agregar movimientos';
        $action = __FUNCTION__;

        return view('zenix.form.add_schedule', compact('page_title', 'page_description', 'action'));

    }

    public function create_schedule(Request $request) {
        $id = Auth::id();
        $schedule = new Schedule;
 
        $schedule->name = $request->nombre;
        $schedule->date = $request->fecha;
        $schedule->scheduled_by = $id;
 
        $schedule->save();
 
        return redirect('/schedules');
    }

    public function show_schedules () {
        $page_title = 'Agenda de palapa';
        $page_description = 'Muestra la agenda de la palapa';
        $action = __FUNCTION__;
       $schedules = Schedule::get();
        return view('zenix.app.schedules', compact('page_title', 'page_description', 'action', 'schedules'));
    }
}
