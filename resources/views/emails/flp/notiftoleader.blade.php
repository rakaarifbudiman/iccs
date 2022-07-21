@extends('emails.mainmail')
@section('content')
<h4>Dear Bapak/Ibu {{ $mailData['name'] }},</h4>
<p>Please review for the following FLP :</p>
<table id="details">
    <tbody>
    <tr>
        <th>Code No</th>
        <td> {{ $mailData['code'] }}</td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td> {{ $mailData['documentname'] }}</td>
    </tr>
    <tr>
        <th>Ingredients</th>
        <td> {!! $mailData['ingredient'] !!}</td>
    </tr>
    <tr>
        <th>Launch Date</th>
        <td> {{ $mailData['flplaunch'] }}</td>
    </tr>    
    <tr>        
        <td colspan="2"> {!! $mailData['urlflp'] !!}</td>
    </tr>
    </tbody>
</table>
<p class="footer">This Email is Auto generated from LUP System Database.</p>
<p class="footer">Please Do Not Reply</p>
<p class="footer">Regards,</p>
@stop