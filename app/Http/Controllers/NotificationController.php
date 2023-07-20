<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    public function add_notification() {

        $page_title = 'Agregar notification';
        $page_description = 'Formulario apra agregar notificacion';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        if ($user->is_admin) {
            return view('zenix.form.add_notification', compact('page_title', 'page_description', 'action'));
        } else {
            return redirect('/');
        }
    }

    public function create_notification(Request $request) {
        $notification = new Notification;
 
        $notification->content = $request->contenido;
        $notification->active = 1;
        $notification->color = $request->color;
        $notification->days_left = $request->dias;
 
        $notification->save(); 
        return redirect('/');
    }
}
