@extends('layouts.main')
@section('title', '| Main Guru')

@section('content')
@if (Session::get('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<h2 class="mb-3">Data Guru</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item">Data Guru</li>

    </ol>
  </nav>
<a href="{{ route('guru.create') }}" class="btn btn-primary mb-2">Tambah</a>
<table class="table table-striped table-bordered table-hover">
<thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @php $no = 1 @endphp

    @foreach($data_guru as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['role'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('guru.edit', $item['id']) }}" class="btn btn-primary me-1">Edit</a>
                <form action="{{ route('guru.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin akan menghapus data ini!')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection