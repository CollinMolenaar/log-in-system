<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class LoginasController extends Controller
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
        $Id = $_POST["id"];
        $TempClassX = DB::table('users')->where('id', $Id)->get();
        $TempClass = $TempClassX[0];
        //store school user
        $_SESSION["rUserEmail"] = Auth::user()->email;
        $_SESSION["rUserPassword"] = Auth::user()->password;
        $_SESSION["rUserid"] = Auth::user()->id;
        $_SESSION["rUserRole"] = Auth::user()->role_id;
        $_SESSION["rUserSchool"] = Auth::user()->school_id;
        $_SESSION["rUserClass"] = Auth::user()->klas_link_id;
        $_SESSION["rUserRemember"] = Auth::user()->remember_token;
        // swap main user
        Auth::user()->email = $TempClass->email;
        Auth::user()->password = $TempClass->password;
        Auth::user()->id = $TempClass->id;
        Auth::user()->role_id = $TempClass->role_id;
        Auth::user()->school_id = $TempClass->school_id;
        Auth::user()->klas_link_id = $TempClass->klas_link_id;
        Auth::user()->remember_token = $TempClass->remember_token;

        if (Auth::user()->role_id === 3 ) {
            $students = DB::table('users')->where('role_id', 4)->where('klas_link_id', Auth::user()->klas_link_id)->get();
            return view('dashboard', ['class' => Auth::user(), 'students' => $students, 'session' => $_SESSION]);
        }
        if (Auth::user()->role_id === 2 ) {
            $students = DB::table('users')->where('role_id', 4)->where('klas_link_id', Auth::user()->klas_link_id)->get();
            return view('dashboard', ['class' => Auth::user(), 'students' =>$students]);
        }

    }
}
