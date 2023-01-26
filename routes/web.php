<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
session_start();
Route::get('/', function () {
    return view('welcome');
});

//dd($_SESSION);
Route::get('/dashboard', function () {
    $role_id =  Auth::user()->role_id;
    if (Auth::user()->role_id === 1 ) {
        $schools = DB::table('users')->where('role_id', 2)->get();
        return view('dashboard', ['admin' => Auth::user(), 'schools' => $schools]);
    }
    if (Auth::user()->role_id === 2 ) {
        $class = DB::table('users')->where('role_id', 3)->where('school_id', Auth::user()->school_id)->get();
        return view('dashboard', ['schools' => Auth::user(), 'class' => $class]);
    }
    if (Auth::user()->role_id === 3) {
        $students = DB::table('users')->where('role_id', 4)->where('klas_link_id', Auth::user()->klas_link_id)->get();
        return view('dashboard', ['class' => Auth::user(), 'students' =>$students]);
    }
    if (Auth::user()->role_id === 4 ) {
        return view('dashboard', ['student' => Auth::user()]);
    }

    echo $role_id;

})->middleware(['auth'])->name('dashboard');
use App\Http\Controllers\TransferController;
Route::post('/transfer_student/', [TransferController::class, 'index']);
Route::post('/transfer', function () {
    $class_id = $_POST["id"];
    $student = DB::table('users')->where('role_id', 4)->where('id', $class_id)->get();
    $otherclass = DB::table('users')->where('role_id', 3)->where('school_id', Auth::user()->school_id)->get();
    return view('transfer_account', ['classes' => $otherclass, 'student' => $student["0"]]);
})->middleware(['auth'])->name('transfer_account');

Route::get('/registe_account', function () {
    $users = DB::table('users')->get();
    $schools = DB::table('schools')->get();
    return view('register_account', ['users' => $users, 'schools' => $schools]);
});
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RemoveController;
use App\Http\Controllers\LoginasController;
Route::post('/registeren/', [RegisterController::class, 'index']);
Route::post('/remove/', [RemoveController::class, 'index']);
Route::post('/loginAs/', [LoginasController::class, 'index']);
Route::post('/rewind/', [LoginasController::class, 'switchBack']);

require __DIR__ . '/auth.php';
 