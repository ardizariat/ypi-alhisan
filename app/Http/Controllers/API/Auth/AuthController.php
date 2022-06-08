<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(LoginRequest $request)
    {
        $data = $request->authenticate();
        return $data;
    }
}
