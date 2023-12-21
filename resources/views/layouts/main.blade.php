<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <title>Pengelolaan Surat  @yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="">Pengelolaan Surat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (Auth::check())
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/home">Dashboard</a>
                    </li>
                    @if (Auth::user()->role === 'staff')

                    <li class="nav-item dropdown">
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Data User
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('staff.') }}">Data Staff Tata Usaha</a></li>
                            <li><a class="dropdown-item" href="{{ route('guru.') }}">Data Guru</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Data Surat
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('klasifikasi.') }}">Data Klasifikasi Surat</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat.') }}">Data Surat</a></li>
                        </ul>
                    </li>

                    @else
               
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('suratGuru.main') }}">Data Surat masuk</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        
                        <a class="nav-link " aria-current="page" href="{{ route('logout') }}">logout</a>
                            
                      
                    </li>
                    {{-- 
                    <li class="nav-item">
                        <a href="" class="nav-link">Logout</a>
                    </li> --}}

                </ul>
            </div>
            @endif

        </div>
    </nav>



    <div class="container mt-5">
        @yield('content')
    </div>






    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
