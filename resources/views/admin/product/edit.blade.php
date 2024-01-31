@extends('master.admin')
@section('title', 'Admin | Edit Product '.$product->name)
@section('main')

<div class="row">
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="col-md-7">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category_id" id="">
                    <option value="">Choice one</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" placeholder="...">{{ $product->description }}</textarea>
            </div>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="..." aria-describedby="helpId">
            </div>
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Sale Price</label>
                <input type="text" name="sale_price" class="form-control" value="{{ $product->sale_price }}" placeholder="..." aria-describedby="helpId">
            </div>
            @error('sale_price')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control" placeholder="..." aria-describedby="helpId">
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <img class="thumbnail" src="uploads/product/{{ $product->image }}" alt="Image" width="100%">
                    </div>
                </div>
            </div>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Multiple images</label>
                <input type="file" name="images[]" class="form-control" placeholder="..." multiple>
                <br>
                <div class="row" style="position: relative;">
                    @foreach ($product->images as $img)
                        <div class="col-md-3">
                            <img class="thumbnail" src="uploads/product/{{ $img->image }}" alt="Image" width="100%">
                            <a onclick="return confirm('Do you want to remove this product image?')" href="{{ route('admin.product.destroyImage', $img->id) }}" style="position: absolute; top: 5px; right: 20px;"><i class="fa fa-trash"></i></a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}> Hidden
                    </label>
                </div>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}> Publish
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
