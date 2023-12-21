<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\isGuruController;
// use App\Models\Letter_type;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::middleware(['isGuest'])->group(function(){
Route::get('/', function () {
    return view('login');
})->name('login.auth2');
Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});


Route::get('/error-permission', function(){
    return view('erros.permission');
})->name('error.permission');


Route::get('/home', [UserController::class, 'index'])->name('home.page')->middleware('loginCheck');


Route::middleware(['loginCheck'])->group(function(){

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});



Route::middleware(['loginCheck', 'IsStaff'])->group(function(){



    Route::prefix('/staff')->name('staff.')->group(function(){
        Route::get('/', [StaffController::class, 'index']);
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/create', [StaffController::class, 'store'])->name('store');
        Route::get('/{id}', [StaffController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('delete');
    });


    Route::prefix('/guru')->name('guru.')->group(function(){
        Route::get('/', [GuruController::class, 'index']);
        Route::get('/create', [GuruController::class, 'create'])->name('create');
        Route::post('/create', [GuruController::class, 'store'])->name('store');
        Route::get('/{id}', [GuruController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [GuruController::class, 'update'])->name('update');
        Route::delete('/{id}', [GuruController::class, 'destroy'])->name('delete');
    });


    Route::prefix('/klasifikasi')->name('klasifikasi.')->group(function(){
        Route::get('/', [LetterTypeController::class, 'index']);
        Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
        Route::get('/data/{id}', [LetterTypeController::class, 'show'])->name('show');
        Route::post('/create', [LetterTypeController::class, 'store'])->name('store');
        Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
        Route::get('/export-excel/data', [LetterTypeController::class, 'exportExcel'])->name('excel');

        Route::get('/pegawai/cetak_pdf/{id}', [LetterTypeCOntroller::class, 'cetak_pdf'])->name('pdf');
        // Route::get('/pegawai/cetak_pdf/{id}', [LetterTypeCOntroller::class, 'cetak_pdf'])->name('temp');
    });


    Route::prefix('/surat')->name('surat.')->group(function(){
        Route::get('/', [LetterController::class, 'index']);
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/', [LetterController::class, 'store'])->name('store');
        Route::get('/data/{id}', [LetterController::class, 'show'])->name('show');         
        Route::get('/surat/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
        Route::get('/{id}', [LetterController::class, 'detail'])->name('detail');
        Route::get('/export-excel/data', [LetterController::class, 'exportExcel'])->name('excel');
        Route::delete('/{id}', [LetterController::class, 'destroy'])->name('delete');
        Route::get('/restore-data/data', [LetterController::class, 'restore'])->name('restore-data');
        Route::get('/restore-data/data/{id}', [LetterController::class, 'restoreProses'])->name('restoreProses');
        Route::delete('/delete-data/data/{id}', [LetterController::class, 'permanen_delete'])->name('delete-permanen');

    });
});

Route::middleware(['loginCheck', 'IsGuru'])->group(function(){
    Route::prefix('/data-surat-guru')->name('suratGuru.')->group(function(){
        Route::get('/surat', [isGuruController::class, 'index'])->name('main');
        Route::get('/{id}', [isGuruController::class, 'create'])->name('create');
        Route::post('/{id}', [isGuruController::class, 'store'])->name('store');
        Route::get('/data/{id}', [isGuruController::class, 'show'])->name('show');
    });
});
