<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $staff = User::where('role', 'staff')->get();
        return view('staff.main', compact('staff'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $request['role'] = 'staff';
        
        $request['password'] = substr($request->name, 0, 3) . substr($request->email, 0, 3);
        User::create($request->all());


       return redirect()->route('staff.')->with('message', 'Berhasil Menambahkan Data Staff TU');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user_staff = User::findOrFail($id);
        return view('staff.edit', compact('user_staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($request->password == null){
            $passwordBaru = $request->password_lama;
        }else{
            $passwordBaru = Hash::make($request->password);
        }

        $request['password'] = $passwordBaru;
        

        $user_staff = User::findOrFail($id);
        $user_staff->update($request->all());

        return redirect()->route('staff.')->with('message', 'Berhasil Mengupdate Data Staff!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_staff = User::findOrFail($id);
        $user_staff->delete();


        return redirect()->route('staff.')->with('message', 'Berhasil Mengahapus Data Staff!');
    }
}
