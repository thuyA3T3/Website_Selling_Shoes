@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>;
@endsection

@section('content')
<form action="{{route('addproduct')}}" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="product">Tên sản phẩm</label>
                <input type="text" name="Name" value="{{old('Name')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
            </div>

            <div class="form-group col-md-6">
                <label>Danh mục</label>
                <select class="form-control" name="CategoryID">
                    @foreach($menus as $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="product">Giá </label>
                <input type="number" name="Price" value="{{old('Price')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
            </div>

        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="Description" value="{{old('Description')}}" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="product">Ảnh sản phẩm</label>
            <input type="file" name="thumb" id="upload" value="{{old('thumb')}}" class="form-control-file">
        </div>
        <div id="image_show">

        </div>
        <input type="hidden" name="thumb" id="thumb">

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>

</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection