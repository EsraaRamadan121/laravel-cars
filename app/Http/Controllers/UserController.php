<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Traits\Common;
use Illuminate\Http\Request;

class UserController extends Controller
{
      use Common;
      
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = User::get();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view('admin.addUser'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $messages= $this->messages();
       $data = $request->validate([
        'fullname' => 'required|max:255',
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
], $messages);
 $data['active']= isset ($request['active']);
 $data['password']= Hash::make($request['password']);
 $data['email_verified_at']= Carbon::now();
 User::create($data);
return view('admin.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = $request->validate([
        'fullname' => 'required|max:255',
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);
        $data['active']= isset ($request['active']);
        User::where('id', $id)->update($data);
        return 'done';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
      public function messages(){
        return [
            'fullname.required'=>'Title is required',
            'username.required'=> 'should be text',
        ];
    }
}
