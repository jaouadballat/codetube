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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channels = $request->user()->subscribers()->with(['videos' => function($query) {
            $query->where('visibility', 'public')->orderBy('created_at', 'desc');
        }])->get();
        
         return view('home', compact('channels'));
    }
}
