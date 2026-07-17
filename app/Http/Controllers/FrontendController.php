<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("Frontend.index");
    }

    public function list()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')->paginate(3);
        return view('Frontend.Partial.list', compact('products', 'categories'));
    }

    public function show($id)
    {
        $categories = Category::all();
        // Use findOrFail to automatically handle cases where the product is not found.
        $product = Product::findOrFail($id);
        return view('Frontend.Partial.show', compact('product', 'categories'));
    }

    public function getBySearch(Request $request)
    {
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "";
        if ($keyword != "") {
            return view('Frontend.Partial.search')
                ->with('products', Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(2))
                ->with('keyword', $keyword);
        } else {
            return view('Frontend.Partial.search')
                ->with('products', Product::paginate(2))
                ->with('keyword', $keyword);
        }
    }

    public function getByCategory($id=0) {
        $categories = Category::all();
        if (!$id) {
            $id = $categories->first()->id;
        }
        $products = DB::table('products')->where('category_id', $id)->paginate(3);
        return view('Frontend.Partial.category')
            ->with('products', $products)
            ->with('categories', $categories);
    }
}
