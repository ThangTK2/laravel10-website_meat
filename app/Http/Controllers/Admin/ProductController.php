<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->only('name', 'price', 'sale_price', 'status', 'description', 'category_id');
        $image_name = $request->image->hashName(); // mã hóa tên
        $request->image->move(public_path('uploads/product'), $image_name);
        $data['image'] = $image_name;
        if ($product = Product::create($data)) {
            if($request->has('images')){
                foreach($request->images as $img){
                    $images_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $images_name);
                    ProductImage::create([
                        'image' => $images_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('success', 'Create new product successfully');
        };
        return redirect()->back()->with('error', 'Create new product failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->select('id', 'name')->get();
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->only('name', 'price', 'sale_price', 'status', 'description', 'category_id');
        $img_name = $product->image;
        $image_path = public_path('uploads/product').'/'.$img_name;
        if($request->has('image')){ //kiểm tra xem có trường nào trong request có tên là 'image' không neu co thi edit
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image_name = $request->image->hashName();
            $request->image->move(public_path('uploads/product'), $image_name);
            $data['image'] = $image_name;
        }
        if ($product->update($data)) {
            if($request->has('images')){
                if ($product->images->count() > 0) {
                    foreach ($product->images as $img) {
                        $other_image = $img->image;
                        $other_path = public_path('uploads/product').'/'.$other_image;
                        if (file_exists($other_path)) {
                            unlink($other_path);
                        }
                    }
                    ProductImage::where('product_id', $product->id)->delete();
                }
                foreach($request->images as $img){
                    $images_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $images_name);
                    ProductImage::create([
                        'image' => $images_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('success', 'Update product successfully');
        };
        return redirect()->back()->with('error', 'Update product failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $img_name = $product->image;
        if ($product->images->count() > 0) {
            foreach ($product->images as $img) {
                $other_image = $img->image;
                $other_path = public_path('uploads/product').'/'.$other_image;
                if (file_exists($other_path)) {
                    unlink($other_path);
                }
            }
            ProductImage::where('product_id', $product->id)->delete();
            if ($product->delete()) {
                $image_path = public_path('uploads/product').'/'.$img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Delete product successfully');
            };
        }else{
            if ($product->delete()) {
                $image_path = public_path('uploads/product').'/'.$img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Delete product successfully');
            };
        }
        return redirect()->back()->with('error', 'Delete product failed');
    }

    public function destroyImage(ProductImage $image)
    {
        $img_name = $image->image;
        if ($image->delete()) {
            $image_path = public_path('uploads/product').'/'.$img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->back()->with('success', 'Delete product image successfully');
        };
        return redirect()->back()->with('error', 'Delete product image failed');
    }
}
