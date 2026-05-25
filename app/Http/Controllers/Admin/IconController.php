<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IconController extends Controller
{
    public function index()
    {
        return view('admin.icon.index');
    }
}