<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function __invoke(Request $request)
    {
            //
    }

    public function index()
    {
        var_dump($_POST);
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->email == $_POST['email']) {
                return redirect('/registe_account');
            }
        }
        if (!empty($_POST['schoolnaam'])) {
            DB::insert('insert into schools (name, address, place) values (?, ?, ?)', [$_POST['schoolnaam'], $_POST['schooladres'], $_POST['schoolplaats']]);
            $schools = DB::table('schools')->get();
            foreach ($schools as $school) {
                echo $school->id;
                if ($school->name == $_POST['schoolnaam']) {
                    $school_id = $school->id;
                }
            }
        }
        if (!empty($_POST['klasnaam'])) {
            DB::insert('insert into classes (name) values (?)', [$_POST['klasnaam']]);
            $classes = DB::table('classes')->get();
            foreach ($classes as $classes2) {
                if ($classes2->name == $_POST['klasnaam']) {
                    $classes_id = $classes2->id;
                }
            }
        }
        if ($_POST['role_id'] == 3) /* klas */ {
            foreach ($users as $user) {
                if (Auth::user()->email == $user->email) {
                    $school_id = $user->school_id;
                }
            }
        }
        if ($_POST['role_id'] == 4) /*student*/ {
            foreach ($users as $user) {
                if (Auth::user()->email == $user->email) {
                    $classes_id = Auth::user()->klas_link_id;
                    echo $classes_id;
                }
            }
        }
        $password = Hash::make($_POST['password']);
        
        if (isset($classes_id) && !isset($school_id)) /* studenten */ {
            $user = new User();
            $user->email = $_POST['email'];
            $user->role_id = $_POST['role_id'];
            $user->password = $password;
            $user->klas_link_id = $classes_id;
            $user->remember_token = $_POST['_token'];
            $user->save();
        }
        if (!isset($classes_id) && isset($school_id)) /* scholen */ {
            DB::insert('insert into users (email, password, role_id, school_id, remember_token) values (?, ?, ?, ?, ?)'
            , [$_POST['email'], $password, $_POST['role_id'], $school_id, $_POST['_token']]);
        }
        if (isset($classes_id) && isset($school_id)) /* studenten */ {
            DB::insert('insert into users (email, password, role_id, school_id, klas_link_id, remember_token) values (?, ?, ?, ?, ?, ?)'
            , [$_POST['email'], $password, $_POST['role_id'], $school_id, $classes_id, $_POST['_token']]);
        }
        
        return redirect('/dashboard');
    }
}
