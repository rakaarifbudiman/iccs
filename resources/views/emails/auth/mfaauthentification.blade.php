<!DOCTYPE html>
<html>
<head>
    <title>ICCS</title>
</head>
<body>
    <h1>Hi {{$mailData['name']}},</h1>
    <p>Since you have login request,</p>
    <p>Here is a key for you to continue Login : </p>
    <p>Key : {{$mailData['key']}}</p>    
    <p>This Key will <strong> expired in 5 minutes</strong> or if you have <strong>success login</strong></p> 
    <p>Thank you</p>
    <p>ICCS</p>
</body>
</html>