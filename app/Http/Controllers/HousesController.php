<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Houses;

class HousesController extends Controller
{
    public function show_houses () {
        $page_title = 'Lista de casas';
        $page_description = 'Muestra la lista de las casas';
        $action = __FUNCTION__;
        $houses = Houses::get();
        return view('zenix.user.houses', compact('page_title', 'page_description', 'action', 'houses'));
    }
}
