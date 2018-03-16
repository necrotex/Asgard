<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Http\Requests\NewApplicationFormRequest;
use Asgard\Models\ApplicationForm;
use Asgard\Models\ApplicationFormQuestion;
use Asgard\Models\Corporation;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = ApplicationForm::all();

        return view('dashboard.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corporations = Corporation::all();

        return view('dashboard.forms.create', compact('corporations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewApplicationFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewApplicationFormRequest $request)
    {
        $form = ApplicationForm::create($request->all());

        return redirect()->route('forms.show', $form);
    }

    /**
     * Display the specified resource.
     *
     * @param ApplicationForm $form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ApplicationForm $form)
    {
        return view('dashboard.forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ApplicationForm $form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ApplicationForm $form)
    {
        return view('dashboard.forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ApplicationForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ApplicationForm $form)
    {
        $form->name = $request->input('name');
        $form->description = $request->input('description');
        $form->save();

        if($request->has('sort_order')) {
            $order = explode(',', $request->input('sort_order'));

            foreach($order as $key => $id) {
                ApplicationFormQuestion::where('id', '=', $id)->update(['order' => $key]);
            }
        }

        return redirect()->route('forms.show', $form);
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
