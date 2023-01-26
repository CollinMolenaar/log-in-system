<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class TransferController extends Controller
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
        $student_id = $_POST["student_id"];
        $klas_link_id = $_POST["klas_link_id"];
        $student = DB::table('users')->where('role_id', 4)->where('id', $student_id)->update(['klas_link_id' => $klas_link_id]);
        return redirect('/dashboard');
    }
}
