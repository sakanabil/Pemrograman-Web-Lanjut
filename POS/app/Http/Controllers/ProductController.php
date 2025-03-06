<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function foodBeverage(){
        return view('kategori.food-beverage');
    }
    public function beautyHealth(){
        return view('kategori.beauty-health');
    }
    public function homeCare(){
        return view('kategori.home-care');
    }
    public function babyKid(){
        return view('kategori.baby-kid');
    }
}