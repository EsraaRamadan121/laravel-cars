<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $messages = Message::get();
        return view('admin.messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("contact");   
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $messages= $this->messages();
       $data = $request->validate([
        'Firstname' => 'required',
        'Lastname' => 'required',
        'Emailaddress' => 'required',
        'content' => 'required',    
], $messages);

 Message::create($data);
Mail::to(env('MAIL_FROM_ADDRESS'))->send(new MessageMail($data));
        return 'done';
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $messages = Message::findOrFail($id);
        return view('admin.showMessage',compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Message::where('id', $id)->delete();
        return redirect()->route('messages');
    }
     public function messages(){
        return [
            'title.required'=>'Title is required',
            'content.required'=> 'should be text',
        ];
    }

public function boot()
{
    $unreadCount = Message::where('read', false)->count();
    View::share('unreadCount', $unreadCount);
}
}
