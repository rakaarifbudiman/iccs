@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>Bukti Close Action LUP berikut telah di reject : {{$mailData['action']}}</p>
<p>Catatan : {{$mailData['note']}}</p>
<p>Mohon kirimkan bukti close yang sesuai</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop