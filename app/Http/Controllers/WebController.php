<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    public function index(Request $request)
    {
        return view('web.home',
        [
            'redirectLink' => $request->has('redirect')
        ]);
    }
}
