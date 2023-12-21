@extends('layouts.main')
@section('title', '| Main Page')

@section('content')
<style>
    .card-body{
    box-shadow: 1px 4px 10px rgba(0, 0, 0, 0.15)
    }

    a{
        text-decoration: none;
    }

    span{
        color: grey;
    }
</style>
    <div class="container mt-5">
        @if (Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <strong> {{ Session::get('message') }}!</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h2>Selamat Datang {{ Auth::user()->name }}</h2>
        
        <div class="grey-bg container-fluid">
            <section id="minimal-statistics">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                  </nav>
            @if (Auth::user()->role == 'staff')
                
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card mt-2">
                        <div class="card-content">
                            <a class="link-1" href="#">
                                <div class="card-body">
                                    <div class="media ">
                                        <div class="media-body text-center">
        
                                            <h3>{{ $letter }}</h3>
                                            <span>Surat Keluar</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card mt-2">
                        <div class="card-content" style="background: ">
                            <a class="link-3" href="">
                                <div class="card-body">
                                    <div class="media ">
                                        <div class="media-body text-center">
                                            <h3>{{ $data_Klasifikasi }}</h3>
                                            <span>Klasifikasi Surat</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card mt-2">
                        <div class="card-content" style="background: ">
                            <a class="link-3" href="">
                                <div class="card-body">
                                    <div class="media ">
                                        <div class="media-body text-center">
                                            <h3>{{ $data_staff }}</h3>
                                            <span>Staff Tata Usaha</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card mt-2">
                        <div class="card-content" style="background: ">
                            <a class="link-3" href="">
                                <div class="card-body">
                                    <div class="media ">
                                        <div class="media-body text-center">
                                            <h3>{{ $data_guru }}</h3>
                                            <span>Guru</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                

                
                
            </div>
            @else
            <div class="">
                <div class="card mt-2">
                    <div class="card-content" style="background: ">
                        <a class="link-3" href="">
                            <div class="card-body">
                                <div class="media ">
                                    <div class="media-body text-center">
                                        <h3>{{ $letter_in }}</h3>
                                        <span>Data surat masuk</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            </div>
        </section>
    </div>
@endsection