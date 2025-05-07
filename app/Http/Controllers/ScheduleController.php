<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function add_schedule() {

        $page_title = 'Agregar ingreso/egreso';
        $page_description = 'Formulario apra agregar movimientos';
        $action = __FUNCTION__;

        return view('zenix.form.add_schedule', compact('page_title', 'page_description', 'action'));

    }

    public function create_schedule(Request $request) {
        $this->validate($request, [
            'fecha' => 'required',
        ]);
        $schedules = Schedule::whereDate('date', date("Y-m-d H:i:s", strtotime($request->fecha)))->get();
        if (count($schedules)) {
            return back()->withErrors([
                'schedule' => 'Ya hay un evento registrado para ese dia.',
            ]);
        }

        if (date('l', strtotime($request->fecha)) == 'Sunday') {
            return back()->withErrors([
                'schedule' => 'No se puede agendar en domingo.',
            ]);
        }

        //dias festivos
        $day = date('dd', strtotime($request->fecha));
        $month = date('mm', strtotime($request->fecha));

        if ($day == '16' && $month == '09') {
            return back()->withErrors([
                'schedule' => 'No se puede agendar en dia festivo.',
            ]);
        } else if ($day == '17' && $month == '11') {
            return back()->withErrors([
                'schedule' => 'No se puede agendar en dia festivo.',
            ]);
        } else if ($day == '25' && $month == '12') {
            return back()->withErrors([
                'schedule' => 'No se puede agendar en dia festivo.',
            ]);
        }

        $id = Auth::id();
        $user = User::find($id)->house;
        $schedule = new Schedule;
 
        $schedule->name = 'Evento casa '.$user->id;
        $schedule->date = $request->fecha;
        $schedule->active = 1;
        $schedule->pool = $request->separar_alberca == 'on' ? 1 : 0;
        $schedule->scheduled_by = $user->id;
 
        $schedule->save();
 
        return redirect('/schedules');
    }

    public function show_schedules () {
        $page_title = 'Agenda de palapa';
        $page_description = 'Muestra la agenda de la palapa';
        $action = __FUNCTION__;
        $schedules = Schedule::where('date', '>=', date('Y-m-d'))->orderBy('created_at', 'DESC')->take(10)->get();
        $past_events = Schedule::where('date', '<', date('Y-m-d'))->orderBy('created_at', 'DESC')->take(5)->get();
        return view('zenix.app.schedules', compact('page_title', 'page_description', 'action', 'schedules', 'past_events'));
    }

    public function delete_old_schedules () {
        Schedule::whereDate('date', '<', Carbon::now())->update(['active' => 0]);
    }
}
