@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>;
@endsection

@section('content')
<form action="{{route('add')}}" method="POST">
    <div class="card-body">

        <div class="form-group">
            <label for="menu">Tên danh mục</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection