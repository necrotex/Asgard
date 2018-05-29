<?php

namespace Asgard\Http\Controllers\Character;

use Asgard\Http\Resources\Ajax\MailResource;
use Asgard\Models\Character;
use Asgard\Models\Character\Mail;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class MailController extends Controller
{

    public function mails(Character $character)
    {
        return DataTables::of($character->mails())->make(true);
    }

    public function mail(Request $request)
    {
        $mail = Mail::where('mail_id', '=', $request->input('id'))->first();

        return view('dashboard.partials.mail.modal', ['mail' => $mail]);
    }
}
