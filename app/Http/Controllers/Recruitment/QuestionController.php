<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\ApplicationForm;
use Asgard\Models\ApplicationFormQuestion;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param ApplicationForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, ApplicationForm $form)
    {

        $this->validate($request,
            [
                'question' => 'required',
            ]
        );

        //get last order number
        $lastOrderNumber = $form->questions()->max('order');

        // If its the first question in this form set it to 1
        if(is_null($lastOrderNumber)) {
            $lastOrderNumber = 0;
        }

        $form->questions()->create(
            [
                'question' => $request->input('question'),
                'description' => $request->input('description', null),
                'required' => $request->has('required'),
                'order' => $lastOrderNumber+1
            ]
        );

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ApplicationFormQuestion $question
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationFormQuestion $question)
    {
        return view('dashboard.forms.question-edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ApplicationFormQuestion $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ApplicationFormQuestion $question)
    {
        $question->update([
            'question' => $request->input('question'),
            'description' => $request->input('description'),
            'required' => $request->has('required'),
        ]);

        return redirect()->route('forms.edit', $question->form);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
