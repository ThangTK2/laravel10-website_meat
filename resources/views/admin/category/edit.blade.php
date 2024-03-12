@extends('master.admin')
@section('title', 'Admin | Sửa Danh Mục')
@section('main')

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control">
                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Ẩn</option>
                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hiện</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>

    </div>
</div>

@endsection
