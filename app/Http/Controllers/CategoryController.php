<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('Categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Categories.Partial.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        // Create The Category
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        Session::flash('category_create','Category is created.');
        return redirect()->route('categories.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('Categories.Partial.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Categories.Partial.Edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'description' => 'required|max:20|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->route('categories.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
        // Create The Category
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        Session::flash('category_update','Category is updated.');
        return redirect()->route('categories.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('category_delete','Category is deleted.');
        return redirect()->route('categories.index');
    }
}
