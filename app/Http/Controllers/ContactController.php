<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;

class ContactController extends BaseController
{
    public function __construct()
    {
        $this->model = Contact::class;
        $this->relation = [''];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['id'];
    }

    public function createForm(Request $request)
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());

        $data = $model::create($validatedData);

        //  Send mail to admin
        \Mail::send('mail', array(
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'user_query' => $request->get('message'),
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('mausoomathfan@gmail.com', 'Admin')->subject($request->get('phone'));
        });

        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

}
