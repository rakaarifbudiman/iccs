<!DOCTYPE html>
<html>
<head>
    <title>ICCS</title>
</head>
<body>
    <h2><span style="color: #0000ff;">Hello <em>{{ $mailData['user'] }}</em> ,</span></h2>
    <h4>To continue the registration process, please fill in the data below and reply to all this email :</h4>
    <table style="border-collapse: collapse; width: 100%; height: 72px;" border="1">
    <tbody>
    <tr style="height: 18px;">
    <td style="width: 20.8117%; height: 18px;">Username</td>
    <td style="width: 79.1883%; height: 18px;">{{ $mailData['user'] }}</td>
    </tr>
    <tr style="height: 18px;">
    <td style="width: 20.8117%; height: 18px;">Department</td>
    <td style="width: 79.1883%; height: 18px;">&nbsp;</td>
    </tr>
    <tr style="height: 18px;">
    <td style="width: 20.8117%; height: 18px;">Leader</td>
    <td style="width: 79.1883%; height: 18px;">&nbsp;</td>
    </tr>
    <tr style="height: 18px;">
    <td style="width: 20.8117%; height: 18px;">Job Grade</td>
    <td style="width: 79.1883%; height: 18px;">Admin/Executive/Supervisor/Manager/Director*</td>
    </tr>
    </tbody>
    </table>
    <p>*Please select one</p>
    <p>Thank you <br />ICCS</p>
</body>
</html>