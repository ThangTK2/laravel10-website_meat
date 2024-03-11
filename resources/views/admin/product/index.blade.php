@extends('master.admin')
@section('title', 'Admin | List Products')
@section('main')

<form class="form-inline" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="" id="" class="form-control" placeholder="Search..." >
        <button type="submit" id="helpId" class="btn btn-danger"><i class="fa fa-search"></i></button>
        <a href="{{ route('product.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
    </div>
</form>

<br>

<table class="table table-striped table-inverse table-responsive table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Status</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cat->name }}</td>  {{-- lấy ra được tên category, cat trong model Product  --}}
                <td>{{ $product->price }} <span class="label label-success">{{ $product->sale_price }}</span></td>
                <td>{{ $product->status == 0 ? 'Hidden' : 'Publish' }}</td>
                <td>
                    <img src="uploads/product/{{ $product->image }}" width="50px" height="65px" alt="Image">
                </td>

                <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post" >
                        @csrf
                        @method('delete')
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <button onclick="return confirm('Do you want to remove this product?')" type="submit" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i> </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
