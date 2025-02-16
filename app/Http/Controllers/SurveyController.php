<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Answer;

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
            'pregunta' => 'required',
        ]);

        $survey = new Survey;
 
        $survey->question = $request->pregunta;
        $survey->description = $request->descripcion;
        $survey->number_of_answers = $request->cantidad;
        $survey->answer_1 = $request->respuesta1;
        $survey->answer_2 = $request->respuesta2;
        $survey->answer_3 = $request->respuesta3;
        $survey->active = 1;
 
        $survey->save(); 
        return redirect('/');
    }

    public function answer_survey(Request $request) {
        $id = Auth::id();
        $user = User::find($id);
        $answer = new Answer;
        $answer->answer = $request->answer;
        $answer->survey_id = $request->survey_id;
        $answer->house_id = $user->houses_id;
        $answer->save(); 
        
        return redirect('/');
    }

    public function minus_one_day_to_notif_and_inactivate_them () {
        Notification::where('active', 1)->decrement('days_left', 1);
        Notification::where('active', 1)->where('days_left', 0)->delete();
    }
}
