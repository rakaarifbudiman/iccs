@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following LUP has request for Closing : #{{$mailData['code']}} ({{$mailData['nolup']}})</p>
<p>Verification</p>
<p>a. All Necessary Documents already created/revised : {{$mailData['verified_a']}}</p>
<p>b. All The Proposed Measured has been implemented : {{$mailData['verified_b']}}</p>
<p>c. Notification Letter / Submission / Approval from Regulatory Authority : {{$mailData['verified_c']}}</p>
<p>Comments : {{$mailData['note']}}</p>
<p>By : {{$mailData['name']}}</p>
<p>Please review and approval</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop