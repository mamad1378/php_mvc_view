<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

class HomeController
{
    public function index()
    {
        //
    }
    
    public function testView()
    {
        return View::render('index', ['message' => 'Hello, World!']);
    }
}
