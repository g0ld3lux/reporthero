<?php

namespace Reporthero\Http\Controllers;

use Illuminate\Http\Request;

use Reporthero\Http\Requests;

class FrontendController extends Controller
{
    public function index()
    {
        flash()->success('Welcome to Laraspace');
        return view('front.index');
    }
}
