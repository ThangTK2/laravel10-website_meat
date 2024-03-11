@extends('master.admin')
@section('title', 'Admin | List Categories')
@section('main')

<form class="form-inline" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="" id="" class="form-control" placeholder="Search..." >
        <button type="submit" id="helpId" class="btn btn-danger"><i class="fa fa-search"></i></button>
        <a href="{{ route('category.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
    </div>
</form>

<br>

<table class="table table-striped table-inverse table-responsive table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">c</td>
            <td>c</td>
            <td>c</td>
            <td>
                <a href="{{ route('category.edit', 1) }}" class="btn btn-sm btn-warning "><i class="fa fa-edit"></i> </a>
                <a href="" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i> </a>
            </td>
        </tr>
    </tbody>
</table>

@endsection
