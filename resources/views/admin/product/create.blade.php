@extends('master.admin')
@section('title', 'Admin | Create Product')
@section('main')

<div class="row">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-7">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category_id" id="">
                    <option value="">Choice one</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control description" placeholder="...">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Multiple images</label>
                <input type="file" name="images[]" class="form-control" multiple  onchange="showMultipleImage(this)">

                <div class="row" id="show_multiple_img" style="padding-top: 12px">
                    <div class="col-md-3">
                        <img class="thumbnail" src="" alt="Image">
                    </div>
                </div>
            </div>
            @error('images')
                <div class="error-message">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="..." aria-describedby="helpId">
            </div>
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Sale Price</label>
                <input type="text" name="sale_price" class="form-control" value="{{ old('sale_price') }}" placeholder="..." aria-describedby="helpId">
            </div>
            @error('sale_price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control" onchange="showImage(this)">

                <div class="row">
                    <div class="col-md-3" style="padding-top: 12px">
                        <img class="thumbnail" id="show_img" alt="Image" width="100%">
                    </div>
                </div>
            </div>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Status</label>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="0"> Hidden
                    </label>
                </div>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="1"> Publish
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
                                <img src="${e.target.result}" alt="Image" width="50%">
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
