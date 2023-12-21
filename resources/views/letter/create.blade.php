@extends('layouts.main')
@section('title', 'bal')
@section('content')

<h2 class="mb-3"> Tambah Data Surat</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item active" aria-current="page">Data Surat</li>
      <li class="breadcrumb-item">Tambah Data Surat</li>

    </ol>
  </nav>

<form action="{{ route('surat.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="main-content card p-3 mb-5" >
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Perihal</label>
            <input type="text" class="form-control" name="letter_perihal">
        </div>
    
    
        <div class="mb-3">
    
            <label for="deskripsi" class="form-label">Klasifikasi</label>
            <select class="form-select" id="role" name="letter_type_id">
                <option value="" hidden>pilih</option>
                @foreach ($letter as $item)
                    <option value="{{ $item['id']}}"> {{ $item['name_type']}}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="content">
            <trix-editor input="deskripsi"></trix-editor>
        </div>
    
        <div class="mb-3">
            <p>Peserta (<b>Ceklis jika "ya"</b>)</p>
            @foreach ($guru as $person)
    
                <label>
                    <input type="checkbox" name="recipients[]" value="{{ $person['id'] }}">
                    {{ $person['name'] }}
                </label><br>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Lampiran</label>
            <input type="file" id="deskripsi"  name="file_upload" class="form-control">
         
        </div>
    
        <div class="mb-3">
    
            <label for="deskripsi" class="form-label">Notulis</label>
            <select class="form-select" id="role" name="notulis">
                <option value="" hidden>pilih</option>
                @foreach ($guru as $item2)
                <option value="{{ $item2['id']}}"> {{ $item2['name']}}</option>
                @endforeach
            </select>
        </div>
    
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        
    </div >
    
</form>
@endsection
