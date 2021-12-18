<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminHome()
    {
        return view('admin.ahome');
    }
    public function operatorHome()
    {
        return view('operator.ohome');
    }
    public function tekshirHome()
    {
        return view('tekshiruvchi.thome');
    }
    public function sotuvHome()
    {
        return view('home');
    }


    public function redirects()
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
        return redirect('/')->with('error','Login Yoki Parol Xato!');
    }
}
