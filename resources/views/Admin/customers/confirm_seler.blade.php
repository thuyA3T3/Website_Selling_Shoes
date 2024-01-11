@extends('admin.main')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>SDT</th>
            <th>Xác Nhận</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $key => $customer)
        @if($customer->role == "wait")
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->FirstName . " " . $customer->LastName}}</td>
            <td>{{$customer->Email }}</td>
            <td>{{$customer->Phone }} </td>
            <td>
                <i class="fas fa-ellipsis-h text-danger"></i> Wait <!-- Biểu tượng dấu x -->
            </td>
            <td>
                <button type="button" class="btn btn-primary mt-n2 btn-danger" data-customer-id="{{ $customer->id }}" data-confirm="0" onclick="handleConfirmClick(this)">Hủy yêu cầu</button>
                <button type="button" class="btn btn-primary mt-n2 btn-success" data-customer-id="{{ $customer->id }}" data-confirm="1" onclick="handleConfirmClick(this)">Xác nhận</button>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endsection