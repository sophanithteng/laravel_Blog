<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('Product.Partial.Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        Log::channel('telegram')->info("📦 New Product Created: {$product->name} (Price: {$product->price})");

        return redirect()->route('product.index')->with('product_create', "Product '{$product->name}' has been created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Product::findOrFail($id);
        return view('product.Partial.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit($id)
    {
  $categories = array();
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        $product = Product::findOrFail($id);
        return view('product.Partial.edit')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'category_id' => 'required|integer',
            'price' => 'required|max:20|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'description' => 'required|max:1000|min:10',
        ]);

        if ($validator->fails()) {
            return redirect('product/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }
        $product = Product::find($id);
        // Create The Post
        if ($request->file('image') != "") {
            $image = $request->file('image');
            $upload = 'img/';
            $filename = time() . $image->getClientOriginalName();
            move_uploaded_file($image->getPathName(), $upload . $filename);
        }

        $product->name = $request->Input('name');
        $product->category_id = $request->Input('category_id');
        $product->price = $request->Input('price');
        if (isset($filename)) {
            $product->image = $filename;
        }

        $product->description = $request->Input('description');
        $product->save();

        Session::flash('product_update', 'Data is updated');
        return redirect('product/' . $product->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     */

public function destroy($id)
    {
        $product = Product::find($id);
        $image_path = 'img/'.$product->image;
        File::delete($image_path);
        $product->delete();
        Session::flash('product_delete','Data is deleted.');
        return redirect('product');
    }
}
