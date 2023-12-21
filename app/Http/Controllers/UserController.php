<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Letter_type;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $auth_username = Auth::user()->name;
        $auth_id = Auth::user()->id;

        $letter = Letter::count();
        $letter_in = Letter::with(['klasifikasi', 'ntls', 'rslt'])->where('recipients', 'like', '%"name":"'. $auth_username .'"%')
                                            ->orWhere('notulis', $auth_id)->get()->count();
        $data_staff = User::where('role', 'staff')->get()->count();
        $data_guru = User::where('role', 'guru')->get()->count();
        $data_Klasifikasi = Letter_type::get()->count();

        return view('home', compact('data_staff', 'data_guru', 'data_Klasifikasi', 'letter', 'letter_in'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)){
            return redirect()->route('home.page')->with('message', 'Login berhasil');
        }else{
            return redirect()->back()->with('failed', 'Proses login gagal');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.auth2')->with('logout', 'Anda telah logout');
    }
}
