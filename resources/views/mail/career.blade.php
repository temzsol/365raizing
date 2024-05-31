<!DOCTYPE html>
<html>
<head>
    <title>Career Form</title>
</head>
<body>
    <p>Job Position : {{$data['job_position']}}</p>
    <p>Full Name : {{$data['fname']}} {{$data['lname']}}</p>
    <p>Email : {{$data['email']}}</p>
    <p>Phone : {{$data['phone']}}</p>
    <p>DOB : {{$data['dob']}}</p>
    <p>Exprience : {{$data['exprience']}}</p>
    <p>Qualification : {{$data['qualification']}}</p>
    <p>Role : {{$data['role']}}</p>
    <p>Current Salary : {{$data['current_salary']}}</p>
    <p>Expected Salary : {{$data['expected_salary']}}</p>
    <p><a href="{{url('/images/attachments/'.$data['attachment'])}}" download>Download Attachment</a></p>
    <p><b>Message :</b><br> {{$data['message']}}</p>
    <br>
    <p>Thank & Regards<br> {{ $data['fname'] }} {{$data['lname']}}</p>
</body>
</html>