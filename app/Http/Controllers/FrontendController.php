<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("frontend.index");
    }

    public function list()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')->paginate(3);
        return view('frontend.partial.list', compact('products', 'categories'));
    }

    public function show($id)
    {
        $categories = Category::all();
        // Use findOrFail to automatically handle cases where the product is not found.
        $product = Product::findOrFail($id);
        return view('frontend.partial.show', compact('product', 'categories'));
    }
}
