<?php

namespace App\Http\Controllers;

use App\Models\Letter_type;
use App\Models\Letter;
use Illuminate\Http\Request;
use Excel;
use PDF;

use App\Exports\KlasifikasiExport;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $letter_data = Letter_type::with('letter')
                        ->where('name_type', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('letter_code' , 'LIKE', '%'.$keyword. '%')

                        ->get();
        return view('klasifikasiSurat.main', compact('letter_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasiSurat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
// ===============================================================
        $newLetter = Letter_type::create($request->all());
        $newLetterId = $newLetter->id;
        $newLetterCode = $newLetter->letter_code;

        
        $request['letter_code'] = $newLetterCode.'-'.$newLetterId;
        Letter_type::find($newLetterId)->update($request->all());
// ================================================================

        return redirect()->route('klasifikasi.')->with('message', 'Berhasil Menambah Data Klasifikasi Surat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $letter_type = Letter_type::with('letter')->findOrFail($id);


       return view('klasifikasiSurat.show', compact('letter_type'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $klasifikasi_edit = Letter_type::findOrFail($id);

        $nomor_surat = explode("-", $klasifikasi_edit['letter_code']);
        $data = $nomor_surat[0];

        // dd($data);
        return view('klasifikasiSurat.edit', compact('klasifikasi_edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $klasifikasi_edit = Letter_type::findOrFail($id);

        $nomor_surat = explode("-", $klasifikasi_edit['letter_code']);
        $data = $nomor_surat[1];

        $request['letter_code'] = $request->letter_code . '-' . $data;

        $klasifikasi_edit->update($request->all());
        

        return redirect()->route('klasifikasi.')->with('message', 'Berhasil Mengupdate Data Klasifikasi Surat!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Letter_type::findOrFail($id);
        $data->delete();

        return redirect()->route('klasifikasi.')->with('message', 'Berhasil Menghapus Data Klasifikasi Surat!');

    }


    public function exportExcel()
    {
        $file_name = 'Klasifikasi_Surat' . '.xlsx';
        return Excel::download(new KlasifikasiExport, $file_name);
    }


    public function cetak_pdf($id)
    {
        // $letter_type = Letter_type::find($id)->toArray();
        $data = Letter::with('klasifikasi')->find($id)->toArray();
        view()->share('data', $data);


        // dd($data);
        $pdf = PDF::loadView('klasifikasiSurat.pdf', $data);

        return $pdf->download('klasifikasi.pdf');
        

    }
}
