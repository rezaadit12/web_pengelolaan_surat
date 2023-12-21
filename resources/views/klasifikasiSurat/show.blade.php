{{-- {{ $letter_type }} --}}
@extends('layouts.main')
@section('title', '| Create Staff')

@section('content')
    <h2 class="mb-3"> Detail Klasifikasi Surat</h2>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Data Staff Tata Usaha</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Data Klasifikasi Surat</li>
            <li class="breadcrumb-item">Detail Klasifikasi Surat</li>

        </ol>
    </nav>
    {{-- @foreach ($letter_type['letter'] as $data)
      {{ $data[''] }}
  @endforeach 
  {{ $letter_type }} --}}
    <b>
        <h2 style="display: inline-block">{{ $letter_type['letter_code'] }}</h2> |  {{ $letter_type['name_type'] }}
    </b>
    <hr>

    @foreach ($letter_type['letter'] as $a)
        <div class="card mt-2 col-md-3">
            <div class="card-content" style="background: ">
                <div class="card-body">
                    <div class="media ">
                        <table>
                            <tr>
                                <td>
                                    <h5>{{ $a['letter_perihal'] }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6>
                                        @php
                                            setlocale(LC_ALL, 'IND');
                                        @endphp
                                        {{ Carbon\Carbon::parse($a['created_at'])->formatLocalized('%d %B %Y') }}
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ol>
                                        @foreach ($a['recipients'] as $b)
                                            
                                            <li>{{ $b['name'] }}<br></li>
                                        @endforeach
                                        
                                    </ol>
                                </td>
                                
                            </tr>
                            <tr>
                                <td> <a href="{{ route('klasifikasi.pdf', $a['id']) }}">Unduf pdf</a></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <br>

@endsection
