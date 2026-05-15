<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserAdminController extends Controller {
    public function index()   { return view('admin.users.index', ['data'=>User::latest()->get()]); }
    public function create()  { return view('admin.users.create'); }

    public function store(Request $request) {
        $request->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6','role'=>'required']);
        User::create([...$request->except('password'), 'password'=>Hash::make($request->password)]);
        return redirect('/admin/users')->with('success','User ditambahkan!');
    }

    public function edit($id)  { return view('admin.users.edit', ['data'=>User::findOrFail($id)]); }

    public function update(Request $request, $id) {
        User::findOrFail($id)->update($request->only('name','email','role','no_telpon'));
        return redirect('/admin/users')->with('success','User diupdate!');
    }

    public function delete($id) { User::destroy($id); return redirect('/admin/users')->with('success','User dihapus!'); }

    public function reset($id) {
        User::findOrFail($id)->update(['password' => Hash::make('12345678')]);
        return redirect('/admin/users')->with('success','Password direset ke: 12345678');
    }
}
