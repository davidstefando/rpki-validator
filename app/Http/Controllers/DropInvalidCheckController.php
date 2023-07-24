<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropInvalidCheckController extends Controller
{
    public function index()
    {
        return view('web.dropInvalidCheck');
    }
}
