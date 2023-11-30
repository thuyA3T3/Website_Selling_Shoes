<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>
    <h1>Confirmation message sent {{ $customer->FirstName . $customer->LastName}}</h1>
    <p></p>
    <p>Please click on one of the following options:</p>

    <form id="approvalForm" action="{{ route('accept',['oder'=>$oder->id, 'token'=>'dghfhjsdgjksd']) }}" method="GET" style="display: inline;">
        <button type="submit">Xác Nhận</button>
    </form>

    <form id="rejectForm" action="{{ route('refuse',['oder'=>$oder->id, 'token'=>'dghfhjsdgjksd']) }}" method="GET" style="display: inline;">
        <button type="submit">Từ chối</button>
    </form>


</body>

</html>