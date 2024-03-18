<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function handle400Error()
    {
        return response()->view('errors.custom_400', [], 404);
    }
    public function handle500Error()
    {
        return response()->view('errors.custom_500', [], 500);
    }
}
