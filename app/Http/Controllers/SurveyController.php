<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurveyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        //
    }

    public function add_survey() {

        $page_title = 'Agregar encuesta';
        $page_description = 'Formulario apra agregar encuesta';
        $action = __FUNCTION__;
        $id = Auth::id();
        $user = User::find($id);
        if ($user->is_admin) {
            return view('zenix.form.add_survey', compact('page_title', 'page_description', 'action'));
        } else {
            return redirect('/');
        }
    }

    public function create_survey(Request $request) {
        $this->validate($request, [
            'contenido' => 'required|max:255',
            'dias' => 'required',
        ]);

        $notification = new Notification;
 
        $notification->content = $request->contenido;
        $notification->active = 1;
        $notification->color = $request->color;
        $notification->days_left = $request->dias;
 
        $notification->save(); 
        return redirect('/');
    }

    public function minus_one_day_to_notif_and_inactivate_them () {
        Notification::where('active', 1)->decrement('days_left', 1);
        Notification::where('active', 1)->where('days_left', 0)->delete();
    }
}
