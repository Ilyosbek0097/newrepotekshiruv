<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt( [
            'name' => $input['name'], 
            'password' => $input['password'] 
            ])  )
        {
           if(auth()->user()->utype == 'tekshiruvchi')
           {
             return view('tekshiruvchi.thome');
           }
           if(auth()->user()->utype == 'operator')
           {
             return view('operator.ohome');
           }
           if(auth()->user()->utype == 'admin')
           {
             return view('admin.ahome');
           }
           if(auth()->user()->utype == 'sotuvchi')
           {
            return view('home');
           }
        //    return redirect()->route('home');
        // return redirect('home');
        return view('home');
        }
        else{
            return redirect()->route('login')->with('error','Login Yoki Parol Xato!');
        }

    }
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }
}
