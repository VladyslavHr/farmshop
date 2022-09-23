<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'last_name' => '',
            'email' => 'required',
            'phone' => '',
            'password' => ['required', 'string', 'min:3'],
        ];


        $message =         [
            'name.required' => 'Vyplňte prosím Jmeno.',
            'email.required' => 'Vyplňte prosím Email.',
            'password.required' => 'Vyplňte prosím heslo.',
        ];

        $data = $request->validate($rules, $message);
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'last_name' => '',
            'email' => 'required',
            'phone' => '',
        ];


        $message =         [
            'name.required' => 'Vyplňte prosím Jmeno.',
            'email.required' => 'Vyplňte prosím Email.',
        ];

        $data = $request->validate($rules, $message);

        $saved = $user->update($data);
        return redirect()->route('admin.users.index');
    }

    public function updatePassword(Request $request, User $user)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:3'],
        ],[
            'password.required' => 'Vyplňte prosím heslo.',
        ]);

        $data['password'] = bcrypt($data['password']);

        $saved = $user->update($data);;

        return redirect()->route('admin.users.index');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

		$user->delete();

        return redirect()->route('admin.users.index');
    }
}
