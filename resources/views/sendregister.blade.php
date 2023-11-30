<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>
    <h1>Confirmation message sent {{ $data['lastName']}}</h1>
    <p></p>
    <p>Please click on one of the following options:</p>

    <form id="approvalForm" action="{{ route('register') }}" method="GET" style="display: inline;">
        <input type="hidden" name="subject" value="{{ $data['subject'] }}">
        <input type="hidden" name="firstName" value="{{ $data['firstName'] }}">
        <input type="hidden" name="lastName" value="{{ $data['lastName'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="phone" value="{{ $data['phone'] }}">
        <input type="hidden" name="password" value="{{ $data['password'] }}">
        <input type="hidden" name="confirmPassword" value="{{ $data['confirmPassword'] }}">

        <button type="submit">Xác Nhận</button>
    </form>

    <form id="rejectForm" action="{{ route('noregister') }}" method="GET" style="display: inline;">
        <button type="submit">Từ chối</button>
    </form>


</body>

</html>