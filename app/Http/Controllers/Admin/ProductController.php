<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Auth;
use File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required',
            'product_name' => 'required|max:50',
            'description'  => 'required',
            'image'        => 'required',
            'price'        => 'required',
        ]);

        // Create New Product
        $data             = $request->except('_token');
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $name = '';
        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = time() . '.' . rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $image->move($destinationPath, $name);

        }
        $data['image'] = $name;

        Product::create($data);

        session()->flash('success', 'Product has been created !!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('backend.pages.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        // Validation Data
        $request->validate([
            'category_id'  => 'required',
            'product_name' => 'required|max:50',
            'description'  => 'required',
            'price'        => 'required',
        ]);

        $data             = $request->except('_token');
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $currentImage = $product->image;
        if ($request->hasFile('image')) {
            $file_path = public_path('images/');

            $image           = $request->file('image');
            $name            = time() . '.' . rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');

            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $image->move($destinationPath, $name);

            if(!empty($currentImage)){
                if (file_exists($destinationPath.$currentImage)){
                    @unlink($destinationPath.$currentImage);
                }
            }

        } else {
            $name = $product->image;
        }
        $data['image'] = $name;

        $product->fill($data)->save();

        session()->flash('success', 'Product has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            $product->delete();
        }

        session()->flash('success', 'Product has been deleted !!');
        return back();
    }
}
