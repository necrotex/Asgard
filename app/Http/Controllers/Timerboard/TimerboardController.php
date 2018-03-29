<?php

namespace Asgard\Http\Controllers\Timerboard;

use Asgard\Models\Timer;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Vinkla\Hashids\Facades\Hashids;

class TimerboardController extends Controller
{
    public function index()
    {
        //Get user and all users roles for data query
        $user = Auth::user();
        $roles = $user->getAssociatedRoles();

        //Get all timers where group matches or ownership, or just not private
        if ($user->can('timer-override')) {
            //Get all timers
            $timers = Timer::all();
        } else {
            //Get timers based on permission
            $timers = Timer::where('ownerId', $user->id)
                ->orWhereNull('forGroup')
                ->orWhereIn('forGroup', $roles)
                ->orWhere('private', false)
                ->orderBy('target', 'asc')
                ->get();
        }

        //remove duplicates
        $timers = $timers->unique();

        $roles = Role::all();

        return view('timerboard.index')->with('timers', $timers)->with('roles', $roles);
    }

    public function new(Request $request)
    {
        $targetDate = null;
        if($request->has('datetime')) {
            $this->validate($request, [
                'datetime'  => 'required|date_format:Y-m-d H:i:s',
                'title'     => 'required|string',
            ]);
            $targetDate = Carbon::parse($request->input('datetime'));
        } else {
            $this->validate($request, [
                'time-days'     => 'required|numeric|digits_between:0,99',
                'time-hours'    => 'required|numeric|digits_between:0,23',
                'time-minutes'  => 'required|numeric|digits_between:0,59',
                'time-seconds'  => 'required|numeric|digits_between:0,59',
                'title'         => 'required|string',
            ]);
            $targetDate = Carbon::now()
                ->addDays($request->input('time-days'))
                ->addHours($request->input('time-hours'))
                ->addMinute($request->input('time-minutes'))
                ->addSeconds($request->input('time-seconds'));
        }

        $user = Auth::user();

        $time = new Timer();
        $time->target = $targetDate;
        $time->title = $request->input('title');

        $limit = $request->input('limitgroup');
        $private = $request->input('private') == null ? false : true;

        if (strtolower($limit) == "none" or $private == true)
            $limit = null;

        $time->forGroup = $limit;
        $time->private = $private;
        $time->modifiedBy = $user->mainCharacter()->first()->name;
        $time->ownerId = $user->id;

        $time->save();

        flash('Timer successfully created!')->success();
        return redirect()->route('timerboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get user and all users roles for data query
        $user = Auth::user();
        $roles = $user->getAssociatedRoles();

        $realId = Hashids::decode($id)[0];
        $timer = Timer::withTrashed()->findOrFail($realId);

        return view('timerboard.single')->with('timer', $timer);
    }

    public function delete($id)
    {
        $user = Auth::user();

        $timer = Timer::findOrFail($id);

        //update modified by to see who deleted it
        $timer->modifiedBy = $user->mainCharacter()->first()->name;
        $timer->save();
        $timer->delete();

        flash('Timer successfully deleted!')->success();
        return redirect()->route('timerboard.index');
    }

    public function edit(Request $request, $id)
    {
        $targetDate = null;
        if($request->has('datetime')) {
            $this->validate($request, [
                'datetime'  => 'required|date_format:Y-m-d H:i:s',
                'title'     => 'required|string',
            ]);
            $targetDate = Carbon::parse($request->input('datetime'));
        } else {
            $this->validate($request, [
                'time-days'     => 'required|numeric|digits_between:0,99',
                'time-hours'    => 'required|numeric|digits_between:0,23',
                'time-minutes'  => 'required|numeric|digits_between:0,59',
                'time-seconds'  => 'required|numeric|digits_between:0,59',
                'title'         => 'required|string',
            ]);
            $targetDate = Carbon::now()
                ->addDays($request->input('time-days'))
                ->addHours($request->input('time-hours'))
                ->addMinute($request->input('time-minutes'))
                ->addSeconds($request->input('time-seconds'));
        }

        $user = Auth::user();

        //Get existing timer for edit, or fail if timer doesn't exists todo some kind of proper error message instead of an exception
        $timer = Timer::findOrFail($id);

        //Update timer with edited values
        $timer->target = $targetDate;
        $timer->title = $request->input('title');

        $limit = $request->input('limitgroup');
        $private = $request->input('private') == null ? false : true;

        if (strtolower($limit) == "none" or $private == true)
            $limit = null;

        $timer->forGroup = $limit;
        $timer->private = $private;
        $timer->modifiedBy = $user->mainCharacter()->first()->name;
        $timer->ownerId = $user->id;

        $timer->save();


        flash('Timer successfully edited!')->success();
        return redirect()->route('timerboard.index');
    }
}
