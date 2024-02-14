<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ReactController extends Controller
{
    public function index()
    {
        return view('public.index');
    }
    public function showCart()
    {
        return view('public.index');
    }

    public function showShop()
    {
        return view('public.index');
    }

    public function showItem($id)
    {
        return view('public.index');
    }
}
