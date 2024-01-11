@extends('admin.main')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>SDT</th>
            <th>Kích hoạt</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $key => $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->FirstName . " " . $customer->LastName}}</td>
            <td>{{$customer->Email }}</td>
            <td>{{$customer->Phone }} </td>
            <td>
                @if($customer->activation)
                <i class="fas fa-check text-success"></i> <!-- Biểu tượng tích -->
                @else
                <i class="fas fa-times text-danger"></i> <!-- Biểu tượng dấu x -->
                @endif
            </td>
            <td>
                @if($customer->activation)
                <button type="button" class="btn btn-primary mt-n2 btn-danger" data-customer-id="{{ $customer->id }}" onclick="handleKhoaClick(this)">Khóa</button>
                @else
                <button type="button" class="btn btn-primary mt-n2 btn-success" data-customer-id="{{ $customer->id }}" onclick="handleKhoaClick(this)">Kích hoạt</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection