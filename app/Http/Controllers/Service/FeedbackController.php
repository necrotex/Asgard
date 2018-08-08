<?php

namespace Asgard\Http\Controllers\Service;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::latest()->paginate(20);
        return view('dashboard.feedback.overview', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.feedback.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hash = \Hash::make($request->user()->id);

        $feedback = Feedback::create(['text' => $request->input('feedback'), 'hash' => $hash]);

        flash('Feedback successfully submitted')->success();

        activity('feedback')->performedOn($feedback)->log('New Feedback post');

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \Asgard\Http\Controllers\Feedback $feedback
     * @return void
     */
    public function show(Feedback $feedback)
    {
        return view('dashboard.feedback.single', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Asgard\Http\Controllers\Feedback $feedback
     * @return void
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \Asgard\Http\Controllers\Feedback $feedback
     * @return void
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Asgard\Http\Controllers\Feedback $feedback
     * @return void
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
