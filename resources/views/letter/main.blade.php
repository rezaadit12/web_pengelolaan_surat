@extends('layouts.main')
@section('title', '| Main Guru')

@section('content')
@if (Session::get('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<h2 class="mb-3">Data Surat</h2>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page">Home</li>
      <li class="breadcrumb-item">Data Surat</li>

    </ol>
  </nav>

 <div class="butt d-flex">
    <form action="" method="get" class="col-md-3">
        <div class="input-group mb-3 ">
          <input type="text" class="form-control" placeholder="Username" name="keyword" aria-label="Username" aria-describedby="basic-addon1">
          <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
      </form>
      <div class="dropdown">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Lihat berdasarkan...
        </a>

        <ul class="dropdown-menu">
            <li>
                <form action="" method="get">
                    <button class="dropdown-item list1" type="submit" name="sortBy" value="desc">DESC</button>
                </form>
            </li>
            <li>
                <form action="" method="get">
                    <button class="dropdown-item list1" type="submit" name="sortBy" value="asc">ASC</button>
                </form>
            </li>
           
        </ul>
    </div>
    <div class="inti">
    <a href="{{ route('surat.create') }}" class="btn btn-primary mb-2">Tambah</a>
    <a href="{{ route('surat.excel') }}" class="btn btn-info mb-2">Export Data Surat</a>
    <a href="{{ route('surat.restore-data') }}" class="btn btn-warning mb-2">Restore Data</a>

    </div>
 </div>



<table class="table table-striped table-bordered table-hover">
<thead>
    <tr>
        <th>No</th>
        <th>Nomor Surat</th>
        <th>Perihal</th>
        <th>Tanggal Keluar</th>
        <th>Penerima Surat</th>
        <th>Notulis</th>
        <th>Hasil Rapat</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @php $no = 1 @endphp

    @foreach($letter as $item)
        <tr>
            <td>{{ ($letter->currentpage() -1)*$letter->perpage() + $loop->index + 1 }}</td>
            <td>{{ $item['klasifikasi']['letter_code'] }}</td>
            <td>{{ $item['letter_perihal']}}</td>
            <td>
                @php
                setlocale(LC_ALL, 'IND');
                @endphp
                {{ Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}</>

            </td>
            </td>
            <td>
                @foreach ($item['recipients'] as $a)
                    {{ $loop->iteration }}.
                    {{ $a['name'] }}<br>
                @endforeach
            </td>
            <td>{{ $item['ntls']['name'] }}</td>
            <td>
                @if ($item['rslt'] !== null)
                    <p class="text-success">Sudah Dibuat</p>
                @else
                    <p class="text-danger">Belum Dibuat</p>
                @endif
            </td>

            <td class="d-flex justify-content-center">
                @if ($item['rslt'] !== null)
                    <a href="{{ route('surat.detail', $item['id']) }}" class="btn me-1" style="color: blue">Lihat</a>

                @else
                    <a href="" class="btn me-1" style="color: blue" onclick="return alert('Hasil rapat belum dibuat!')">Lihat</a>

                @endif
                <a href="{{ route('surat.edit', $item['id']) }}" class="btn btn-primary me-1">Edit</a>
                <form action="{{ route('surat.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
<div class="mt-4 mb-3">
    {{ $letter->withQueryString()->links() }}
  </div>
@endsection