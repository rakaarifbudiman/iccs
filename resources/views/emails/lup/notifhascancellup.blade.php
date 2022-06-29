@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following LUP has been Cancel: {{$mailData['code']}}</p>
<p>Verified By : {{$mailData['review']}}</p>
<p>Approved By : {{$mailData['approver']}}</p>
<p>Comments : {{$mailData['note']}}</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop