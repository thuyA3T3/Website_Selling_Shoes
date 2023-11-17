@extends('admin.main')


@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Update</th>

            <th style="width: 150px;">&nbsp</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->Name}}</td>
            <td>{{$product->CategoryID }}</td>
            <td>{{$product->Price }} </td>
            <td>{{$product->Description }} </td>
            <td>{{$product->updated_at }} </td>

            <td>

                <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{$product->id}}">
                    <i class="fas fa-edit"></i>
                </a>

                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('{{ $product->id }}',' /admin/product/destroy ')">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $products->links() !!}
@endsection