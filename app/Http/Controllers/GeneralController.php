<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Movement;
use App\Models\Houses;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    // Dashboard
    public function show_index()
    {

        $page_title = 'Inicio';
        $page_description = 'Pagina principal';
        $action = __FUNCTION__;
        $balance = General::where('name', 'balance')->value('value');

        $ingresos = Movement::whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("-1 week")), date("Y-m-d H:i:s")])->where('type', 'ingreso')->sum('quantity');
        $egresos = Movement::whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("-1 week")), date("Y-m-d H:i:s")])->where('type', 'egreso')->sum('quantity');

        $houses = Houses::where('active', 0)->get();
        $id = Auth::id();
        $user = User::find($id)->house;

        return view('zenix.dashboard.index', compact('page_title', 'page_description', 'action', 'balance', 'ingresos', 'egresos', 'houses', 'user'));

    }

    public function open_gate(){
        $response = Http::get('https://www.virtualsmarthome.xyz/url_routine_trigger/activate.php?trigger=f6fee870-5658-41c4-8b11-fe795f8298a9&token=bef983a5-596d-4d67-9eee-6f965f66e33b&response=json');
        print_r($response->json());
        //return redirect('/index');
    }
}
