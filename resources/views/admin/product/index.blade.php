@extends('master.admin')
@section('title', 'Admin | Danh Sách Sản Phẩm')
@section('main')

<form action="" class="form-inline">
    <div class="form-group">
        <input type="text" name="keyword" id="" class="form-control" placeholder="Tìm kiếm..." >
        <button type="submit" id="helpId" class="btn btn-danger"><i class="fa fa-search"></i></button>
    </div>
    <a href="{{ route('product.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
</form>

<br>

<table class="table table-striped table-inverse table-responsive table-bordered text-center">
    <thead class="thead-inverse">
        <tr>
            <th>STT</th>
            <th>Tên Sản Phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cat->name }}</td>  {{-- lấy ra được tên category, cat trong model Product  --}}
                <td>{{ $product->price }} | <span class="label label-success">{{ $product->sale_price }}</span></td>
                <td>{{ $product->status == 0 ? 'Hidden' : 'Publish' }}</td>
                <td>
                    <img src="uploads/product/{{ $product->image }}" width="50px" height="65px" alt="Hình ảnh">
                </td>

                <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post" >
                        @csrf
                        @method('delete')
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <button onclick="return confirm('Bạn có muốn xóa sản phẩm này?')" type="submit" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i> </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $products->appends(request()->all())->links() }}  {{-- khi tiềm kiếm nó vẫn hiện --}}
@endsection
