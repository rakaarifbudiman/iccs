<!DOCTYPE html>
<html>
<head>
    <title>ICCS</title>
</head>
<body>
    <h1>Hi {{$mailData['name']}},</h1>
    <p>Since you have requested a password reset,</p>
    <p>Here is a link for you to reset password</p>
    <p>{!!$mailData['url']!!}</p>    
    <p>This Link will <strong> expired in {{env('SESSION_LIFETIME')}} minutes</strong> or if you have <strong>success change</strong> your password </p> 
    <p>Thank you</p>
    <p>ICCS</p>
</body>
</html>