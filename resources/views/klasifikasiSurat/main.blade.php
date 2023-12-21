@extends('layouts.main')
@section('title', '| Main Guru')

@section('content')
@if (Session::get('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<h2 class="mb-3">Data Klasifikasi Surat</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item">Data Klasifikasi Surat</li>

    </ol>
  </nav>

  <form action="" method="get" class="col-md-3">
    <div class="input-group mb-3 ">
      <input type="text" class="form-control" placeholder="Username" name="keyword" aria-label="Username" aria-describedby="basic-addon1">
      <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </div>
  </form>
<a href="{{ route('klasifikasi.create') }}" class="btn btn-primary mb-2">Tambah</a>
<a href="{{ route('klasifikasi.excel') }}" class="btn btn-info mb-2">Export Klasifikasi Surat</a>

<table class="table table-striped table-bordered table-hover">
<thead>
    <tr>
        <th>No</th>
        <th>Kode Surat</th>
        <th>Klasifikasi Surat</th>
        <th>Surat Tertaut</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @php $no = 1 @endphp

    @foreach($letter_data as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['letter_code'] }}</td>
            <td>{{ $item['name_type'] }}</td>
            <td>{{ count($item['letter']) }}</td>

            {{-- <td>{{ $item['role'] }}</td> --}}
            <td class="d-flex justify-content-center">
                <a href="{{ route('klasifikasi.show', $item['id']) }}" class="btn me-1" style="color: blue">Lihat</a>
                <a href="{{ route('klasifikasi.edit', $item['id']) }}" class="btn btn-primary me-1">Edit</a>
                <form action="{{ route('klasifikasi.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin akan mengahapus ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection