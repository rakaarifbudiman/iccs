@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>Action LUP berikut telah diperpanjang due date nya: {{$mailData['action']}}</p>
<p>Alasan Perpanjangan : {{$mailData['note']}}</p>
<p>Due Date Awal: @date($mailData['old_duedate'],'d-M-y')</p>
<p>New Due Date: @date($mailData['duedate'],'d-M-y')</p>
<p>By : {{$mailData['pic']}}</p>
<p>Mohon review dan approvalnya</p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop