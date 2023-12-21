@extends('layouts.main')
@section('title', '| Create Staff')

@section('content')
<h2 class="mb-3">Edit Data Guru</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
      <li class="breadcrumb-item">Edit Data Guru</li>
    </ol>
  </nav>
<form action="{{ route('guru.update', $data_guru['id']) }}" method="POST" class="card p-5">
    @csrf
    @method('patch')
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
        <label for="name" class="col-sm-2 col-form-label">Nama :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $data_guru['name'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Email :</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $data_guru['email'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Password :</label>
        <div class="col-sm-10">
            <input type="hidden" value="{{ $data_guru['password'] }}" name="password_lama">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
@endsection