<?php

namespace Asgard\Http\Controllers;

use Asgard\Models\Character;
use Asgard\Models\User;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('view-full-systemlog')) {
            $messages = Activity::with(['subject', 'causer'])->limit(150)->latest()->paginate(10);
        } else {
            if (auth()->user()->can('view-recruitment-systemlog')) {
                $messages = Activity::with(['subject', 'causer'])->whereIn('log_name', ['recruitment', 'info'])->limit(150)->latest()->paginate(10);
            } else {
                $messages = Activity::with(['subject', 'causer'])->where('log_name', '=', 'info')
                    ->where(function ($q) {
                        $q->where(function ($qq) {
                            $qq->where('subject_type', '=', User::class)->where('subject_id', '=', auth()->user()->id);
                        })
                            ->orWhere(function ($qq) {
                                $qq->where('subject_type', '=', Character::class)->whereIn('subject_id',
                                    auth()->user()->characters->pluck('id')->toArray());

                            });
                    })
                    ->limit(150)->latest()->paginate(10);
            }
        }

        return view('dashboard.home', compact('messages'));
    }
}
