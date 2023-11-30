<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>
    <h1>Confirm password change</h1>
    <p></p>
    <p>Please click on one of the following options:</p>

    <form id="approvalForm" action="{{route('acceptPass')}}" method="GET" style="display: inline;">
        <input type="hidden" class="form-control" value="{{$mail}}" name="mail" type="text">
        <input type="hidden" class="form-control" value="{{$pass}}" name="pass" type="text">
        <button type="submit">Xác Nhận</button>
    </form>

    <form id="rejectForm" action="{{route('refusePass')}}" method="GET" style="display: inline;">
        <button type="submit">Không phải tôi</button>
    </form>


</body>