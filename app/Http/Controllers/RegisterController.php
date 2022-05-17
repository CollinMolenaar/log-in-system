<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        if ($_POST['role_id'] == 3) {
            foreach ($users as $user) {
                if (Auth::user()->email == $user->email) {
                    $school_id = $user->school_id;
                }
            }
        }
        $password = Hash::make($_POST['password']);
        echo $password;
        DB::insert('insert into users (email, password, role_id, school_id, remember_token) values (?, ?, ?, ?, ?)', [$_POST['email'], $password, $_POST['role_id'], $school_id,
        $_POST['_token']]);
        return redirect('/dashboard');
    }
}
