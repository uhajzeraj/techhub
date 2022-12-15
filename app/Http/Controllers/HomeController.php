<?php

namespace App\Http\Controllers;

final class HomeController
{
    public function home()
    {
        return view('welcome');
    }
}
