<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\Result;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IsGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_username = Auth::user()->name;
        $auth_id = Auth::user()->id;

        $letter = Letter::with(['klasifikasi', 'ntls', 'rslt'])->where('recipients', 'like', '%"name":"'. $auth_username .'"%')
                                            ->orWhere('notulis', $auth_id)->paginate(2);
        return view('isGuru.main', compact('letter'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $letter = Letter::findOrFail($id);
        return view('isGuru.show', compact('letter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $arrayDistinct = array_count_values($request->recipients);
        $arrayAssoc = [];
        foreach($arrayDistinct as $id => $count){
            $user = User::where('id', $id)->first();

            $arrayItem = [
                "id" => $id,
                "name" => $user['name'],
            ];
            array_push($arrayAssoc, $arrayItem);
        }

        $request['presence_recipients'] = $arrayAssoc;
        Result::create($request->all());

        return redirect()->route('suratGuru.show', $request->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rslt = Result::where('letter_id', $id)->get();
        $data = Letter::with('klasifikasi')->find($id);
        
        return view('isGuru.result', ['data' => $data, 'rslt' => $rslt]);

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
}
