<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');

    }

    public function store(CategoryCreateRequest $request)
    {
        $data = $request->only('name', 'status');
        if (Category::create($data)) {
            return redirect()->route('category.index')->with('success', 'Tạo danh mục mới thành công');
        };
        return redirect()->back()->with('error', 'Tạo danh mục mới không thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'status'));

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        // Thực hiện truy vấn để tìm kiếm các danh mục có tên chứa từ khóa
        $categories = Category::where('name', 'LIKE', "%$keyword%")->get();
        return view('admin.category.index', compact('categories'));
    }
}
