<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
        // dd( $products);
        return view('admin.product.product', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation

        $request->validate([
            'name' => 'required|min:3 |max:25',
            'price' => 'required|numeric|gt:0',
            'image' => 'required|image|mimes:png,jpg,jpeg ',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        //uploade file
        $path = $request->file('image')->store('images', 'upfile');

        $data = $request->except('_token', 'image');
        $data['image'] = $path;
        Product::create($data);

        return redirect()
            ->route('admin.show_product')
            ->with('msg', 'Product Added Successfuly')
            ->with('icon', 'success');

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.prodshow', compact('product'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3 |max:25',
            'price' => 'required|numeric|gt:0',
            'image' => 'nullable|image|mimes:png,jpg,jpeg ',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        //uploade file
        $product=Product::findOrFail($id);

        $data = $request->except('_token', 'image');
        if ($request->hasFile('image')) {
            File::delete(public_path($product->image));
            $path = $request->file('image')->store('images', 'upfile');
            $data['image'] = $path;
        }

        $product->update($data);


        return redirect()
            ->route('admin.show_product')
            ->with('msg', 'Product Updated Successfuly')
            ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Product::destroy($id);
        $product=Product::findOrFail($id);
        File::delete(public_path($product->image));

        $product->delete();

        return redirect()
            ->route('admin.show_product')
            ->with('msg', 'Product Deleted Successfuly')
            ->with('icon', 'error');
    }
}
