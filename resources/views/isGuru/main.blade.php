@extends('layouts.main')
@section('title', '| Main Page')

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
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item">Data Guru</li>
        </ol>
    </nav>

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
           

            @foreach ($letter as $item)
                <tr>
                    <td>{{ ($letter->currentpage() -1)*$letter->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item['klasifikasi']['letter_code'] }}</td>
                    <td>{{ $item['klasifikasi']['name_type'] }}</td>
                    {{-- <td>{{ $item['klasifikasi']['created_at'] }}</td> --}}
                    {{-- berdasarkan surat --}}
                    <td>
                        @php
                        setlocale(LC_ALL, 'IND');
                        @endphp
                        {{ Carbon\Carbon::parse($item['created_at'])->formatLocalized('%d %B %Y') }}<br><br>
                    </td>
                    <td>
                        @foreach ($item['recipients'] as $name_rcp)
                            {{ $loop->iteration }}.
                            {{ $name_rcp['name'] }}<br>
                        @endforeach
                    </td>
                    <td>{{ $item['ntls']['name'] }}</td>
                    <td>
                        @if ($item['rslt'] !== null)
                            <p class="text-success">Sudah Dibuat</p>
                        @else
                            @if ($item['notulis'] === Auth::user()->id)
                                <a href="{{ route('suratGuru.create', $item['id']) }}" class="btn btn-outline-warning">Buat Hasil Rapat</a>
                            @else
                                <p class="text-danger">Belum Dibuat</p>
                            @endif
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('suratGuru.show', $item['id']) }}" class="btn btn-primary me-1">Lihat</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 mb-3">
        {{ $letter->withQueryString()->links() }}
      </div>
@endsection
