<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\ApplicationInvite;
use Asgard\Models\ApplicationForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    public function forms()
    {
        $forms = ApplicationForm::where('active', '=', true)->get();

        if(is_null($forms))
            return response()->json([]);

        $formatted = [];
        foreach($forms as $form) {
            $formatted['results'][] = ['id' => $form->id, 'text' => $form->name];
        }

        return response()->json($formatted);
    }

    public function inviteCode(Request $request) {

        $this->validate($request, [
            'form' => 'required|numeric'
        ]);

        $form = ApplicationForm::find($request->input('form'));

        $code = $this->generateCode();

        ApplicationInvite::create([
            'code' => $code,
            'application_form_id' => $form->id,
            'user_id' => auth()->user()->id,
            'expiry' => Carbon::now()->addDays(2)
        ]);

        return route('applications.invite.landing', $code);
    }

    private function generateCode()
    {
        $invite = false;
        do {
            $code = Str::random(16);
            $invite = ApplicationInvite::where('code', '=', $code)->first();

        } while (!is_null($invite));

        return $code;
    }

    public function setupApplication(Request $request, $invite)
    {
        $invite = ApplicationInvite::where('code', '=', $invite)->firstOrFail();

        if($invite->expiry < Carbon::now()) {
            return abort(403, 'Invite code expired. Please talk to a recruiter to receive a new invite link');
        }

        $request->session()->push('recuritment_code', $invite->code);


        return view('auth.invite-login', compact('invite'));
    }
}
