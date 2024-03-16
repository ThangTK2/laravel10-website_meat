@extends('master.admin')
@section('title', 'Admin | Edit Product '.$product->name)
@section('main')

<div class="row">
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="col-md-7">
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="...">
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Danh mục</label>
                <select class="form-control" name="category_id" id="">
                    <option value="">Chọn một</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control description" placeholder="...">{{ $product->description }}</textarea>
            </div>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Chọn nhiều ảnh</label>
                <input type="file" name="images[]" class="form-control" multiple  onchange="showMultipleImage(this)">
                <br>
                <div class="row" style="position: relative;">
                    @foreach ($product->images as $img)
                        <div class="col-md-3">
                            <img class="thumbnail" src="uploads/product/{{ $img->image }}" alt="Hình ảnh" width="100%">
                            <a onclick="return confirm('Do you want to remove this product image?')" href="{{ route('admin.product.destroyImage', $img->id) }}" style="position: absolute; top: 5px; right: 20px;"><i class="fa fa-trash"></i></a>
                        </div>
                    @endforeach
                </div>

                <label>Các ảnh mới chọn sẽ thay thế ảnh cũ trước đó: </label>
                <div class="row" id="show_multiple_img">
                    <div class="col-md-3">
                        <img class="thumbnail" src="" alt="Hình ảnh">
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="...">
            </div>
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Giá khuyến mãi</label>
                <input type="text" name="sale_price" class="form-control" value="{{ $product->sale_price }}" placeholder="...">
            </div>
            @error('sale_price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="image" class="form-control" onchange="showImage(this)">
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <img class="thumbnail" src="uploads/product/{{ $product->image }}" alt="Hình ảnh" width="100%" id="show_img">
                    </div>
                </div>
            </div>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}> Ẩn
                    </label>
                </div>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}> Hiện
                    </label>
                </div>
            </div>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="admin_assets/plugins/summernote/summernote.min.css">
@endsection

@section('js')
    <script src="admin_assets/plugins/summernote/summernote.min.js"></script>
    <script>
        $('.description').summernote({
            height: 300
        })

        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#show_img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showMultipleImage(input) {
            if (input.files && input.files.length) {
                var _html = ``
                for (let i = 0; i < input.files.length; i++) {
                    var file = input.files[i];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        _html += `
                            <div class="">
                                <img src="{e.target.result} đ" alt="Hình ảnh" width="50%"
                            </div>
                        `
                        $('#show_multiple_img').html(_html);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

    </script>
@endsection
