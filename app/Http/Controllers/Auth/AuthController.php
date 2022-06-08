<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $body = [
            'login' => $request->login,
            'password' => $request->password,
        ];
        $req = Http::post(prefixAPI() . "/login", [
            'login' => $request->login,
            'password' => $request->password,
        ]);
        $status = $req->ok();
        if (!$status) return back();

        $res = $req->json();
        $name  = 'Authorization';
        $token  =  $res['data']['token_type'] . ' ' . $res['data']['access_token'];
        $cookie = cookie($name, $token, 10);
        return cookie($cookie);
    }
}
