@extends('admin.main')


@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Update</th>
            <th style="width: 150px;">&nbsp</th>
        </tr>
    </thead>
    <tbody>
        {!! \App\Helpers\Helper::menu($menus) !!}
    </tbody>
</table>
@endsection