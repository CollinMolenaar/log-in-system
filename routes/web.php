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

Route::get('/', function () {
    return view('welcome');
});

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
    if (Auth::user()->role_id === 3 ) {
        return view('dashboard', ['class' => Auth::user()]);
    }
    echo $role_id;

})->middleware(['auth'])->name('dashboard');

Route::get('/registe_account', function () {
    $users = DB::table('users')->get();
    $schools = DB::table('schools')->get();
    return view('register_account', ['users' => $users, 'schools' => $schools]);
});
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RemoveController;

Route::post('/registeren/', [RegisterController::class, 'index']);
Route::post('/remove/', [RemoveController::class, 'index']);

require __DIR__ . '/auth.php';
 