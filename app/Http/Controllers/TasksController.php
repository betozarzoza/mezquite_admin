<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
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
use Carbon\Carbon;


class TasksController extends Controller
{
    public function tasks(){
        $page_title = 'tasks';
        $page_description = 'Tareas';
        $action = __FUNCTION__;
        $tasks =  Task::get();
        return view('zenix.table.tasks', compact('page_title', 'page_description', 'action', 'tasks'));
    }

    public function add_task(){
        $page_title = 'add_task';
        $page_description = 'Agregar tarea';
        $action = __FUNCTION__;
        return view('zenix.form.add_task', compact('page_title', 'page_description', 'action'));
    }

    public function complete_task (Request $request) {
        $task = Task::find($request->task_id);
        $task->status = 'completada';
        $task->save();
        return redirect('/tasks');
    }

    public function waiting_task (Request $request) {
        $task = Task::find($request->task_id);
        $task->status = 'en espera';
        $task->save();
        return redirect('/tasks');
    }    
}
