<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\User;
use App\Models\Result;
use Excel;
use App\Exports\SuratExport;
use App\Models\Letter_type;

use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $sort = $request->sortBy;

        if ($sort == 'asc') {
            $letter = Letter::with(['klasifikasi','ntls', 'rslt'])->orderBy('id', 'ASC')->paginate(5);
        }else if($sort == 'desc'){
            $letter = Letter::with(['klasifikasi','ntls', 'rslt'])->orderBy('id', 'DESC')->paginate(5);
        }else{
            $letter = Letter::with(['klasifikasi','ntls', 'rslt'])
                            ->where('letter_perihal', 'LIKE', '%'.$keyword.'%')

                            ->orWhereHas('klasifikasi', function($query) use($keyword) {
                                // global $keyword;
                                $query->where('letter_code', 'LIKE', '%'.$keyword.'%');
                            })->paginate(5);
        }
        return view('letter.main', compact('letter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letter = Letter_type::all();
        $guru = User::where('role', 'guru')->get(['id', 'name']);

        return view('letter.create',compact('letter', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->file());

        $newName = '';

        if($request->file('file_upload')){
            $gambarNameExtension = $request->file('file_upload')->getClientOriginalExtension(); /* untuk mengambil nama ekstensi dari gambar seperti jpg, png, dll */
            $newName = $request->letter_perihal.'-'.$request->letter_type_id.'-'.now()->timestamp.'.'.$gambarNameExtension; 
            $request->file('file_upload')->storeAs('img', $newName);
        }
        // dd($newName);
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
        $request['attachment'] = $newName;
        $request['recipients'] = $arrayAssoc;
        $result = Letter::create($request->all());

        // $idLetter = Letter::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        return redirect()->route('surat.show', $result->id);
        return redirect()->route('surat.')->with('message', 'Berhasil Menambahkan Data Surat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Letter::with('klasifikasi')->find($id);
        return view('klasifikasiSurat.temp', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter2 = Letter_type::all();

        $letter = Letter::with('ntls','klasifikasi')->findOrFail($id);
        $guru = User::where('role', 'guru')->get(['id', 'name']);

        
        return view('letter.edit', compact('letter', 'guru', 'letter2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_surat)
    {
        if($_FILES['file_upload']['error'] == 4 ){
            $gambar = $request->file_upload_lama;
        }else if($request->file('file_upload')){
            $gambarNameExtension = $request->file('file_upload')->getClientOriginalExtension(); /* untuk mengambil nama ekstensi dari gambar seperti jpg, png, dll */
            $gambar = $request->letter_perihal.'-'.$request->letter_type_id.'-'.now()->timestamp.'.'.$gambarNameExtension; 
            $request->file('file_upload')->storeAs('img', $gambar);
        }


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
        $request['recipients'] = $arrayAssoc;
        $request['attachment'] = $gambar;
        $result = Letter::findOrFail($id_surat);
        $result->update($request->all());
        return redirect()->route('surat.')->with('message', 'Berhasil Mengupdate Data Surat!');

    }

    public function detail($id)
    {
        $rslt = Result::where('letter_id', $id)->get();

        $data = Letter::with('klasifikasi')->find($id);
        return view('letter.detail', ['data' => $data, 'rslt' => $rslt]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);
        $letter->delete();


        return redirect()->route('surat.')->with('message', 'Berhasil Menghapus Data Klasifikasi Surat!');
    
    }


    public function exportExcel()
    {
        $file_name = 'Surat' . '.xlsx';
        return Excel::download(new SuratExport, $file_name);
    }


    public function restore()
    {
        $restoreData = Letter::onlyTrashed()->get();
        return view('letter.recyle', ['dataRestore'=> $restoreData]);
    }

    public function restoreProses($id)
    {
        $restoreProses = Letter::withTrashed()->where('id', $id)->restore();

        return redirect()->route('surat.')->with('message', 'Restore berhasil');

    }


    public function permanen_delete($id)
    {
        Result::where('letter_id', $id)->delete();
        $letter = Letter::withTrashed()->findOrFail($id);
        $letter->forceDelete();

        return redirect()->back()->with('message', 'Berhasil Menghapus Data Surat!');

    }
}

