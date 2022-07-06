<!DOCTYPE html>
<html>
<head>
    <title>ICCS</title>
</head>
<body>
    <h1>Hi {{$mailData['name']}},</h1>
    <p>You received this mail because your account have too many request Login attempts</p>
    <p>Here is the detail </p>
    <p>User-Agent : {{$mailData['user-agent']}}</p>    
    <p>IP Address : {{$mailData['ip']}}</p>   
    <p> </p> 
    <p>Thank you</p>
    <p>ICCS</p>
</body>
</html>