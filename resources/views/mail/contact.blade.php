<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <p>Full Name : {{$data['name']}}</p>
    <p>Email : {{$data['email']}}</p>
    <p>Phone : {{$data['phone']}}</p>
    <p><b>Message :</b><br> {{$data['message']}}</p>
    <br>
    <p>Thank & Regards<br> {{ $data['name'] }}</p>
</body>
</html>