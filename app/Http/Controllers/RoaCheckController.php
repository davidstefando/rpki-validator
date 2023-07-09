<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoaCheckRequest;
use Illuminate\Http\Request;

class RoaCheckController extends Controller
{
    public function index(RoaCheckRequest $request)
    {
        return view('web.roaCheck', [
            'prefix' => $request->prefix,
            'as' => $request->as
        ]);
    }
}
