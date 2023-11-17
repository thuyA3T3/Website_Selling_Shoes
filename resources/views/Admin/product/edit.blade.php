@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>;
@endsection

@section('content')
<form action="" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="product">Tên sản phẩm</label>
                <input type="text" name="Name" value="{{ $product->Name }}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
            </div>

            <div class="form-group col-md-6">
                <label>Danh mục</label>
                <select class="form-control" name="CategoryID">
                    @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $product->CategoryID == $menu->id ? 'selected' : '' }}>
                        {{ $menu->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="product">Giá </label>
                <input type="number" name="Price" value="{{$product->Price}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
            </div>

        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="Description" value="{{$product->Description}}" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="product">Ảnh sản phẩm</label>
            <input type="file" name="thumb" id="upload" class="form-control-file">
        </div>
        <div id="image_show">
            <a href="value=" {{$product->thumb}}" target="_blank">
                <img src="{{$product->thumb}}" width="200px">
            </a>
        </div>
        <input type="hidden" name="thumb" value="{{$product->thumb}}" id="thumb">

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>

</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection