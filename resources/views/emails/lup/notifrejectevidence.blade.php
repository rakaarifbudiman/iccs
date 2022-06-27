@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following Close Evidence of LUP Action has been rejected : {{$mailData['action']}}</p>
<p>Note : {{$mailData['note']}}</p>
<p>Please send the appropriate close evidence</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop