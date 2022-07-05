@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu {{$mailData['to']}},</h4>
<p>Please Revise The following LUP : #{{$mailData['code']}}</p>
<p>Title : {{$mailData['title']}}</p>
<p>Comments : {{$mailData['note']}}</p>
<p>By : {{$mailData['name']}}</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop