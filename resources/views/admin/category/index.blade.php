@extends('master.admin')
@section('title', 'Admin | Danh Sách Danh Mục')
@section('main')

<form action="" class="form-inline">
    <div class="form-group">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm...">
        <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
    </div>
    <a href="{{ route('category.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
</form>


<br>

@if ($categories->isEmpty())
    <p>Không tìm thấy danh mục nào.</p>;
@else
    <table class="table table-striped table-inverse table-responsive table-bordered text-center">
        <thead class="thead-inverse">
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <button onclick="return confirm('Bạn có muốn xóa danh mục này?')" type="submit" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
{{ $categories->appends(request()->all())->links() }}
@endsection
