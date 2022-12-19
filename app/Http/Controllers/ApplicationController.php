<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplication;
use App\Mail\ApplicationMail;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function __invoke(StoreApplication $request)
    {
        $application = Application::create($request->validated());

        Mail::to(config('mail.home.address'))
            ->bcc('david@dsc.co.uk')
            ->queue(new ApplicationMail($application));

        return view('auth.registration-sent');
    }
}
