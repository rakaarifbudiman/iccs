@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following Due Date Action need to be confirmed: {{$mailData['nolup']}}</p>
<p>Title : {{$mailData['title']}}</p>
<p>Proposed Change : {!!$mailData['proposed']!!}</p>
<p>Detail Action :</p>
@forelse ($lupactions as $lupaction)
    <ul>
    <li>{{$lupaction->action}} - {{$lupaction->pic->name}} - @date($lupaction->duedate_action,'d-M-y')</li>
    </ul>
@empty    
@endforelse
<p>Please review and sign</p>
<p>If you do not sign after <strong>3 days</strong>, system will <strong>auto sign with the above due date</strong></p>
<p>{!!$mailData['urllup']!!}</p>

<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop