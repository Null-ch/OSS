<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\SpecialOffer;

class IndexController extends Controller
{
    public function __invoke()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersCount = Order::count();
        $reviewsCount = Review::count();
        $specialOffersCount = SpecialOffer::count();
        return view('admin.main.index', compact('usersCount', 'productsCount', 'categoriesCount', 'ordersCount', 'reviewsCount', 'specialOffersCount'));
    }
}
