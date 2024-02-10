<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        $products = Product::all();
        $categories = Category::all();
        $orders = Order::all();
        $reviews = Review::all();
        return view('admin.main.index', compact('users', 'products', 'categories', 'orders', 'reviews'));
    }
}
