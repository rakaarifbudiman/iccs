@extends('emails.mainmail')
@section('content')
<h4>Dear All,</h4>
<h5>The following LUP has been APPROVED </h5>
<table id="details">
    <tbody>
    <tr>
        <th>Code No</th>
        <td> {{ $mailData['code'] }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td> {{ $mailData['documentname'] }}</td>
    </tr>
    <tr>
        <th>Current Condition</th>
        <td> {!! $mailData['lup_current'] !!}</td>
    </tr>
    <tr>
        <th>Proposed Change</th>
        <td> {!! $mailData['lup_proposed'] !!}</td>
    </tr>
    <tr>
        <th>Reason of Change</th>
        <td> {!! $mailData['lup_reason'] !!}</td>
    </tr>
    <tr>
        <th>Risk Assestment</th>
        <td> {!! $mailData['risk_assestment'] !!}</td>
    </tr>
    <tr>
        <th>Categorization</th>
        <td> {{ $mailData['categorization'] }}</td>
    </tr>
    <tr>
        <th>Due Date Implementation</th>
        <td> {{ $mailData['duedate'] }}</td>
    </tr>
    <tr>        
        <td colspan="2"> {!! $mailData['urllup'] !!}</td>
    </tr>
    </tbody>
</table>
<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop