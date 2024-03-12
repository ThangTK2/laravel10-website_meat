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
            return redirect()->route('product.index')->with('success', 'Tạo sản phẩm mới thành công');
        };
        return redirect()->back()->with('error', 'Tạo sản phẩm mới không thành công');
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
    public function update(ProductUpdateRequest $request, Product $product) //$product: là đối tượng Product có thông tin chi tiết của sản phẩm
    {
        $data = $request->only('name', 'price', 'sale_price', 'status', 'description', 'category_id');
        $img_name = $product->image;
        $image_path = public_path('uploads/product').'/'.$img_name; //public_path: trả về đường dẫn đến thư mục public
        if($request->has('image')){ //kiểm tra xem có trường nào trong request có tên là 'image' không neu co thi edit
            // Kiểm tra và xóa file ảnh chính cũ
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image_name = $request->image->hashName();
            $request->image->move(public_path('uploads/product'), $image_name);
            $data['image'] = $image_name;
        }

        // Cập nhật thông tin sản phẩm với dữ liệu mới
        if ($product->update($data)) {
            // Kiểm tra nếu có ảnh phụ
            if($request->has('images')){
                // Xóa ảnh phụ cũ
                if ($product->images->count() > 0) {
                    foreach ($product->images as $img) {
                        $other_image = $img->image;
                        $other_path = public_path('uploads/product').'/'.$other_image;
                        if (file_exists($other_path)) {
                            unlink($other_path);
                        }
                    }
                    // Xóa các ảnh phụ trong database
                    ProductImage::where('product_id', $product->id)->delete();
                }
                // Tạo và lưu các ảnh phụ mới
                foreach($request->images as $img){
                    $images_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $images_name);
                    ProductImage::create([
                        'image' => $images_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
        };
        return redirect()->back()->with('error', 'Cập nhật sản phẩm không thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $img_name = $product->image;
        // Kiểm tra nếu có ảnh phụ(vì bảng Product này có khóa ngoại nên xóa ảnh phụ trước)
        if ($product->images->count() > 0) {
            // Xóa từng ảnh phụ và file trong thư mục lẫn db
            foreach ($product->images as $img) {
                $other_image = $img->image;
                $other_path = public_path('uploads/product').'/'.$other_image;
                if (file_exists($other_path)) {
                    unlink($other_path);
                }
            }
            // Xóa các ảnh phụ trong database
            ProductImage::where('product_id', $product->id)->delete();

            // Xóa sản phẩm chính
            if ($product->delete()) {
                $image_path = public_path('uploads/product').'/'.$img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công');
            };
        }else{
            if ($product->delete()) {
                $image_path = public_path('uploads/product').'/'.$img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công');
            };
        }
        return redirect()->back()->with('error', 'Xóa sản phẩm không thành công');
    }

    public function destroyImage(ProductImage $image) //$image là một đối tượng của lớp ProductImage
    {
        $img_name = $image->image;
        if ($image->delete()) {
            $image_path = public_path('uploads/product').'/'.$img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->back()->with('success', 'Xóa hình ảnh sản phẩm thành công');
        };
        return redirect()->back()->with('error', 'Xóa hình ảnh sản phẩm không thành công');
    }
}
