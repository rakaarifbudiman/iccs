@extends('emails.mainnotif')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fbfbfb;" width="100%">
        <tbody>
        <tr>
        <td>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #175df1;" width="100%">
        <tbody>
        <tr>
        <td>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
        <tbody>
        <tr>
        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 15px; border: 0px;" width="100%">
        <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
        <tbody>
        <tr>
        <td style="padding-left: 10px; padding-right: 10px; padding-top: 25px;">
        <div style="font-family: sans-serif;">
        <div style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2;">
        <p style="margin: 0; font-size: 30px; text-align: center;">Dear Bapak/Ibu <span style="color: #ffffff;">{{ $mailData['nameleader'] }}</span>,</p>
        <p style="margin: 0; font-size: 25px; text-align: center;">Mohon reviewnya untuk FLP berikut :</p>
        </div>
        </div>
        </td>
        </tr>
        </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" class="addon_block" role="presentation" style="width: 100%; height: 93px;" width="648" height="106">
        <tbody>
        <tr style="height: 93px;">
        <td style="width: 100%; padding-right: 0px; padding-left: 0px; height: 93px;">
        <div align="center" style="line-height: 10px;"><img alt="arrow" src="https://media0.giphy.com/media/d25jSx6Zto72XbajAR/giphy.gif?cid=20eb4e9d75en9swmt846m3pkvcsdgok95dwoyy47oz9tcjrn&amp;rid=giphy.gif&amp;ct=s" style="display: block; height: 99px; width: 79px; max-width: 100%;" title="arrow" width="130" /></div>
        </td>
        </tr>
        </tbody>
        </table>
        <table border="1" cellpadding="8" cellspacing="0" class="list_block" role="presentation" style="height: 164px; width: 100%; border-style: none;" width="100%">
        <tbody>
        <tr style="height: 21px;">
        <td style="width: 21.5123%; height: 21px; border-style: none;"><span style="color: #ffffff;">Code&nbsp;</span></td>
        <td style="width: 38.4876%; height: 21px; border-style: none;"><span style="color: #ffffff;">: {{ $mailData['code'] }}</span></td>
        </tr>
        <tr style="height: 31px;">
        <td style="width: 21.5123%; height: 31px; border-style: none;"><span style="color: #ffffff;">Product Name&nbsp;</span></td>
        <td style="width: 38.4876%; height: 31px; border-style: none;">
        <p><span style="color: #ffffff;">: {{ $mailData['productname'] }}</span></p>
        </td>
        </tr>
        <tr style="height: 31px;">
        <td style="width: 21.5123%; height: 31px; border-style: none;"><span style="color: #ffffff;">Launch Date&nbsp;</span></td>
        <td style="width: 38.4876%; height: 31px; border-style: none;">
        <p><span style="color: #ffffff;">: {{ $mailData['flplaunch'] }}</span></p>
        </td>
        </tr>
        <tr style="height: 30px;">
        <td style="width: 21.5123%; border-style: none; height: 30px;"><span style="color: #ffffff;">Active Ingredients&nbsp;</span></td>
        <td style="width: 38.4876%; border-style: none; height: 30px;">
        <p><span style="color: #ffffff;">: {{ $mailData['ingredient'] }}</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
        <tbody>
        <tr>
        <td style="text-align: center; padding: 15px 10px 30px 10px;">
        <div align="center">
        <p>{!! $mailData['urlsign'] !!} <span style="color: #ffffff;">OR</span> {!! $mailData['urlflp'] !!}</p>
        </div>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9c253;" width="100%">
        <tbody>
        <tr>
        <td>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
        <tbody>
        <tr>
        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border: 0px;" width="100%">
        <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
        <tbody>
        <tr>
        <td style="padding: 5px 10px 20px 10px;">
        <div style="font-family: sans-serif;">
        <div style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;">
        <p style="margin: 0; font-size: 14px; text-align: center;">This Email is Auto generated from LUP System Database<br />Please Do Not Reply<br />Regards<br />Thank you</p>
        </div>
        </div>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
        <tbody>
        <tr>
        <td></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!-- End -->
