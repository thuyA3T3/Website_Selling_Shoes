<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>
    <h1>Email Confirmation for {{ $data['firstName'] }}</h1>
    <p></p>
    <p>Please click one of the following links:</p>

    <form id="approvalForm" action="{{ route('register') }}" method="post" style="display: inline;">
        @csrf
        <button type="submit">hh</button>
    </form>

    <form id="rejectForm" action="#" method="post" style="display: inline;" onclick="getsend('reject'); return false;">
        @csrf
        <button type="submit">Reject</button>
    </form>


</body>

</html>