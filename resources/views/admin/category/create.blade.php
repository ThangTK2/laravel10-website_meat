@extends('master.admin')
@section('title', 'Admin | Thêm Mới Danh Mục')
@section('main')

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" name="name" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="0"> Ẩn
                    </label>
                </div>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="1"> Hiện
                    </label>
                </div>
            </div>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Thêm</button>
        </form>
    </div>
</div>

@endsection
