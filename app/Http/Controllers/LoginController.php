<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    function login(Request $request){
        $this->validate($request, [
            'username' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'password' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
        ]);
        $credentials = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]);
        if ($credentials == TRUE){
            return redirect('home')->with('success','Berhasil Melakukan Login');
        } else {
            return redirect('login')->with('error','Gagal Melakukan Login');
        }
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('login');
    }

    // Api Android
    public function loginMember(Request $request)
    {
        if ($token = Auth::guard('member')->attempt(["username" => $request->username, "password" => $request->password])) {
            return $this->respondWithToken($token);
        } else {
            return response()->json("Error");
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            "data" => Auth::guard('member')->user()
        ]);
    }
}
