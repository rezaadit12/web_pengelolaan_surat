

@extends('layouts.main')
@section('title', '| Create Staff')

@section('content')
<h2 class="mb-3">Tambah Data Klasifikasi Surat</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item active" aria-current="page">Data Klasifikasi Surat</li>
      <li class="breadcrumb-item">Tambah Data Klasifikasi Surat</li>

    </ol>
  </nav>
<form action="{{ route('suratGuru.store' , $letter['id']) }}" method="POST" class="card p-5">
    @csrf
    <input type="hidden" name="letter_id" value="{{ $letter['id'] }}">
    <div class="mb-3">
        <p>Peserta (<b>Ceklis jika "hadir"</b>)</p>
        @foreach ($letter['recipients'] as $person)

            <label>
                <input type="checkbox" name="recipients[]" value="{{ $person['id'] }}">
                {{ $person['name'] }}
            </label><br>
        @endforeach
    </div><br>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Ringkasan Hasil Rapat</label>
        <input id="deskripsi" type="hidden" name="notes">
        <trix-editor input="deskripsi"></trix-editor>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Buat</button>
</form>


@endsection