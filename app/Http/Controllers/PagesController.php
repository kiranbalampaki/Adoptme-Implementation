<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Pet;
use App\Product;
use App\ProductCategory;

class PagesController extends Controller
{
    public function index(){
        $pets = Pet::where('is_adopted','0')->orderBy('id','desc')->take(4)->get();
        $blogs = Blog::orderBy('id','desc')->take(3)->get();
        $products = Product::orderBy('id','desc')->take(4)->get();
        $category = ProductCategory::all();
        return view('pages.index', compact('pets', 'blogs','products','category'));
    }

    public function about(){
        $title='About Us';
    }

    public function help(){
        return view('pages.help');
    }

    public function contact()
    {
        return view('contact');
    }

    public function cart(){
        return view('cart');
    }
}
