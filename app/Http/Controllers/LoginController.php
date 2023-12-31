<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function page(){
        return view('page');
    }
    public function dashboard(){
        
        return redirect()->route('a.dashboard');
    }

    public function login()
    {
        if (Auth::check()) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('a.dashboard');
            }
            elseif (auth()->user()->role_id == 2) {
                return redirect()->route('m.dashboard');
            }
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        // dd($request);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('a.dashboard');
            }
            elseif (auth()->user()->role_id == 2) {
                return redirect()->route('m.dashboard');
            }
        }
        else{
            Session::flash('gagal', 'Email atau Password Salah');
            return redirect('/login');
        }
        
    }

    public function actionlogout(Request $request)
    {
        // Auth::logout();
        // return redirect('/login');
        Auth::guard()->logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
    
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    public function error(){
        return view('login');
    }
}
