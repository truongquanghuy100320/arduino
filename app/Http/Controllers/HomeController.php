<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public  function content()
    {
      return view('homes.dashboard');
    }

    public  function dashboard()

    {
        return view('homes.dashboard');
    }
}
