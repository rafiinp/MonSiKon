<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Logika untuk metode index
        return view('home'); // Misalnya, mengembalikan tampilan 'home'
    }
}
