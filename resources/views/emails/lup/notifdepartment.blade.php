@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu ,</h4>
<p>The following LUP need to be reviewed: <strong>{{$lup->code}}</strong></p>
<p>Title : {{$mailData['title']}}</p>
<p>Proposed Change : {!!$mailData['proposed']!!}</p>
<p>Related Department :</p>
@forelse ($relateddepartments as $relateddepartment)
    <ul>
    <li>{{$relateddepartment->department}} - {{$relateddepartment->user->name}}</li>
    </ul>
@empty    
@endforelse
<p>Please review and sign</p>
<p>{!!$mailData['urllup']!!}</p>
<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop