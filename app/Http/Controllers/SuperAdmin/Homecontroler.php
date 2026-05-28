<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homecontroler extends Controller
{
    public function index()
    {

        // dd('vào đây');
        return view('super-admin.dashboard');
    }
}
