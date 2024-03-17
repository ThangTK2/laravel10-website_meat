@extends('master.admin')
@section('title', 'Admin | Danh Sách Người dùng')
@section('main')
    <form action="" class="form-inline">
        <div class="form-group">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm...">
            <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <br>
    <table class="table table-striped table-inverse table-responsive table-bordered text-center">
        <thead class="thead-inverse">
            <tr>
                <th>STT</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có muốn xóa người dùng này?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $customers->appends(request()->all())->links() }}
@endsection
