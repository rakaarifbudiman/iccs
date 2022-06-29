@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following LUP has request for Cancellation: {{$mailData['code']}}</p>
<p>Justification : {{$mailData['note']}}</p>
<p>By : {{$mailData['name']}}</p>
<p>Please review and approval</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop