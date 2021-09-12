<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.signin');
    }
    public function customSignup(Request $request)
    {
   
        $data = $request->all();
        $check = $this->createUser($data);
        return ($check)? redirect("dashboard")->withSuccess('Successfully logged-in!'):redirect("register")->withErrors('Try again!');
    }
    public function signup()
    {
        return view('auth.signup');
    }

    public function createSignin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Logged-in');
        }
        return redirect("login")->withSuccess('Credentials are wrong.');
    }

    public function createUser(array $data)
    {

      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'user_type'=>$data['usertype'],
        'cnic'=>$data['cnic'],
        'address'=>$data['address'],
        'phone_num'=>$data['phonenum']

      ]);
    }


    public function dashboardView()
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }
        return redirect("login")->withSuccess('Access is not permitted');
    }


    public function logout() {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('login');
    }
}
