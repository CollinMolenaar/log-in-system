<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RemoveController extends Controller
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
        $id = $_POST['id'];
        if ($_POST['value'] == 'user') {
            DB::table('users')->where('id', $id)->delete();
            return redirect('/dashboard');
        } elseif (isset($_POST['school_id'])) {
            $school_id = $_POST['school_id'];
            DB::table('users')->where('school_id', $school_id)->delete();
            DB::table('schools')->where('id', $id)->delete();
            return redirect('/dashboard');
        } else {
            DB::table('users')->where('id', $id)->delete();
            return redirect('/dashboard');
        }
    }
}
