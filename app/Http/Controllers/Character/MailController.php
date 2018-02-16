<?php

namespace Asgard\Http\Controllers\Character;

use Asgard\Http\Resources\Ajax\MailResource;
use Asgard\Models\Character;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class MailController extends Controller
{

    public function mails(Character $character)
    {
        return DataTables::of($character->mails())->make(true);
    }

    public function mail(Request $request, $character)
    {
        return new MailResource(Character\Mail::where('mail_id', '=', $request->input('id'))->first());
    }
}
