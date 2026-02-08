<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::withCount('products')->orderBy('id', 'desc')->paginate(10);
        return view('admin.category.category', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.category.add_category', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3 |max:25',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg ',
        ]);

        //uploade file
        $path = $request->file('image')->store('category_images', 'upfile');

        $data = $request->except('_token', 'image');
        $data['image'] = $path;
        Category::create($data);

        return redirect()
            ->route('admin.category.show')
            ->with('msg', 'Product Added Successfuly')
            ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::withCount('products')->findOrFail($id);
        return view('admin.category.catshow', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3 |max:25',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg ',
        ]);

        //uploade file
        $category = Category::findOrFail($id);

        $data = $request->except('_token', 'image');
        if ($request->hasFile('image')) {
            File::delete(public_path('category_images', $category->image));
            $path = $request->file('image')->store('category_images', 'upfile');
            $data['image'] = $path;
        }

        $category->update($data);


        return redirect()
            ->route('admin.category.show')
            ->with('msg', 'Category Updated Successfuly')
            ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()
            ->route('admin.category.show')
            ->with('msg', 'Product Deleted Successfuly')
            ->with('icon', 'error');
    }
}
