<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        // 用CreateUser驗證
        $validatedData = $request->validated();
        // 存入資料庫的格式
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $user->save();
        return response('success', 201);
    }

    public function login(Request $request)
    {
        // 登入驗證
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // 失敗的回應
        if (!Auth::attempt($validatedData)){
            return response('授權失敗', 401);
        }
        // 建立token
        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();

        return response(['token' => $tokenResult->accessToken]);
        dump($tokenResult);
    }

    public function user(Request $request)
    {
        $user = Auth::guard('api')->user();
        return response($request->user);
    }

}
