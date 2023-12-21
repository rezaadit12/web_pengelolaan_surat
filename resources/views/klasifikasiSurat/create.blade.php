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
<form action="{{ route('klasifikasi.store') }}" method="POST" class="card p-5">
    @csrf

    {{-- @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif --}}
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Kode Surat :</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="name" name="letter_code">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Klasifikasi Surat :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="name_type">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
@endsection