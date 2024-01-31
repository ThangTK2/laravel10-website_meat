@extends('master.admin')
@section('title', 'Admin | Edit Category')
@section('main')

<div class="row">
    <div class="col-md-4">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
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

            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
        </form>
    </div>
</div>

@endsection
