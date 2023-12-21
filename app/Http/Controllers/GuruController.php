<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_guru = User::where('role', 'guru')->get();
        return view('guru.main', compact('data_guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
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
        
        $request['role'] = 'guru';
        $request['password'] = substr($request->name, 0, 3) . substr($request->email, 0, 3);
        User::create($request->all());

        return redirect()->route('guru.')->with('message', 'Berhasil Menambah Data Guru!');

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
        $data_guru = User::findOrFail($id);
        return view('guru.edit', compact('data_guru'));
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
        $request['role'] = 'guru';

        $data_guru = User::findOrFail($id);
        $data_guru->update($request->all());

        return redirect()->route('guru.')->with('message', 'Berhasil Mengupdate Data Guru!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_guru = User::findOrFail($id);
        $data_guru->delete();


        return redirect()->route('guru.')->with('message', 'Berhasil Menghapus Data Guru!');
    }
}
