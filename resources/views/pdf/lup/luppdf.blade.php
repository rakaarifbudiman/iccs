<!DOCTYPE html>
<html>
<head>	
	@if (!$lup->nolup)
		<title>{{ $lup->code }}</title>
	@else
		<title>{{ $lup->nolup }}</title>
	@endif
	<title>{{ $lup->nolup }}</title>
	<style>
		h1 {
		font-size: 18px!important;font-weight: bold;
		text-align: center; color:#004890
		}
		*{
			font-size: 12px;
		}
		
		@page { 
			margin-top: 0.5cm;
			margin-bottom: 0.5cm;
		}
		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;			
		}
		.flex-container {
		display: flex;
		width: 100%;
		justify-content: space-between;
		background-color: DodgerBlue;
		}
		p.break { 
                word-break: break-all; 
            } 
		.flex-container > div {
		background-color: #f1f1f1;		
		text-align: center;		
		font-size: 12px;
		}
		td{
			padding-left: 3px;
		}
        .page-break {
        page-break-after: always;        
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
	</style>
</head>
<body>
	<header>	
		<table style="height: 127px; width: 100.553%; vertical-align: top;">
			<tbody>
				<tr style="height: 18px; border-style: none;">
					<td style="width: 10%; height: 18px; border-style: none; vertical-align: top;" >
						<img style="height: 90px; margin-top: 15px;" src="assets/img/logo-sgh.PNG" />	
					</td>
					<td style="width: 100%; height: 36px; border-style: none; vertical-align: bottom;">
						<h1> Change Control #{{ $lup->code }}<br>No : {{ $lup->nolup }}							
						</h1>
					</td>
					<td style="width: 25%; height: 18px; border-style: none; vertical-align: top;">
						<img style="height: 80px;float: right; margin-top: 15px;" src="{{$qrcodepath}}" />  
					</td>					
				</tr>
			</tbody>
		</table>
	</header>
<div name="details">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top;">
	<tbody>
		<tr style="height: 18px; border-style: none;">
			<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Inisiator</small></strong></td>
			<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
			<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $lup->inisiator ? $lup->inisiators->name :''}}</small></td>
			<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
			<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Inisiator Department</small></strong></td>
			<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
			<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;text-align:right"><small>{{ $lup->inisiator ? $lup->inisiators->department :'' }}</small></td>
		</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32.4514%; height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff"><strong>I. Change Initiation</strong></td>
		<td style="width: 32.4514%; height: 18px; border-bottom: double; background-color: #004890;  color:#ffffff; text-align:right" colspan="6"><small>Date Created : @date($lup->date_input,'d-M-y') | Date Approved : @date($lup->dateapproved,'d-M-y') | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Title/Short Description</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><small>{{ $lup->documentname}}&nbsp;</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Change Related To</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $lup->lup_type }}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>If Others (Specify)</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $lup->lup_type_others }}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Change Sub Category</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><small>{{ $lup->lup_subtype}}&nbsp;</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Change Type</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $lup->duedate_type }}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Due Date Implementation</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;"><small>
            @if ($lup->duedate_type=="Temporary")
                @date($lup->duedate_start,'d-M-y') until @date($lup->duedate_finish,'d-M-y')
            @else
                @date($lup->duedate_start,'d-M-y')
            @endif            
        </small>
        </td>
	</tr>
	<tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Current Condition</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{!! $lup->lup_current !!}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Proposed Change</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{!! $lup->lup_proposed !!}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Reason For Change</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{!! $lup->lup_reason !!}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Other Product Impacted </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{{ $lup->relatedmaterial->count() > 0 ? 'Yes' : 'No'  }}</small></td>
	</tr>
    @if($lup->relatedmaterial->count() > 0 )
        <tr style="height: 36px; border-style: none;">
            <td style="width: 100%; height: 36px; border-style: none; vertical-align: top;" colspan="7">
                <div name="relatedmaterial">
                    <table style="width: 100%; border-collapse: collapse; " border="1">
                        <tbody>
                        <tr style="background-color: #0072e5;  color:#ffffff">
                            <th style="width: 4.39716%;">No</th>
                            <th style="width: 10%;">Part Number</th>
                            <th style="width: 35.6028%;">Description</th>                            
                        </tr>
                        @forelse ($lup->relatedmaterial as $index=>$relatedmaterial)
                            <tr>
                            <td style="width: 5%;"><small>{{ $index +1 }}</small></td>
                            <td style="width: 35%;"><small>{{ $relatedmaterial->partsap }}</small></td>
                            <td style="width: 25%;"><small>{{ $relatedmaterial->partdesc }}</small></td>                            
                            </tr>
                        @empty                
                        @endforelse            
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif
    <tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Utility/Equipment/Facility Impacted </small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{{ $lup->relatedutility->count() > 0 ? 'Yes' : 'No'  }}</small></td>
	</tr>
    @if($lup->relatedutility->count() > 0)
        <tr style="height: 36px; border-style: none;">
            <td style="width: 100%; height: 36px; border-style: none; vertical-align: top;" colspan="7">
                <div name="relatedutility">
                    <table style="width: 100%; border-collapse: collapse; " border="1">
                        <tbody>
                        <tr style="background-color: #0072e5;  color:#ffffff">
                            <th style="width: 4.39716%;">No</th>
                            <th style="width: 10%;">Area / ID Number</th>
                            <th style="width: 35.6028%;">Description</th>                                  
                        </tr>
                        @forelse ($lup->relatedutility as $index=>$relatedutility)
                            <tr>
                            <td style="width: 5%;"><small>{{ $index +1 }}</small></td>
                            <td style="width: 35%;"><small>{{ $relatedutility->area }}</small></td>
                            <td style="width: 25%;"><small>{{ $relatedutility->description }}</small></td>                                
                            </tr>
                        @empty                
                        @endforelse            
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Revise Document Needed</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{{ $lup->relateddocument->count() > 0 ? 'Yes' : 'No'  }}</small></td>
	</tr>
    @if($lup->relateddocument->count() > 0)
        <tr style="height: 36px; border-style: none;">
            <td style="width: 100%; height: 36px; border-style: none; vertical-align: top;" colspan="7">
                <div name="relateddocument">
                    <table style="width: 100%; border-collapse: collapse; " border="1">
                        <tbody>
                        <tr style="background-color: #0072e5;  color:#ffffff">
                            <th style="width: 4.39716%;">No</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 35.6028%;">Document Number</th>     
                            <th style="width: 35.6028%;">Document Title</th>                               
                        </tr>
                        @forelse ($lup->relateddocument as $index=>$relateddocument)
                            <tr>
                            <td style="width: 5%;"><small>{{ $index +1 }}</small></td>
                            <td style="width: 35%;"><small>{{ $relateddocument->type }}</small></td>
                            <td style="width: 25%;"><small>{{ $relateddocument->doc_number }}</small></td>    
                            <td style="width: 25%;"><small>{{ $relateddocument->doc_title }}</small></td>                              
                            </tr>
                        @empty                
                        @endforelse            
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Supportive Attachments</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{{ $lup->lupfile->count() > 0 ? 'Yes' : 'No'  }}</small></td>
	</tr>
    @if($lup->lupfile->count() > 0)
        <tr style="height: 36px; border-style: none;">
            <td style="width: 100%; height: 36px; border-style: none; vertical-align: top;" colspan="7">
                <div name="attachment">
                    <table style="width: 100%; border-collapse: collapse; " border="1">
                        <tbody>
                        <tr style="background-color: #0072e5;  color:#ffffff">
                            <th style="width: 4.39716%;">No</th>
                            <th style="width: 10%;">Attachment Title</th>
                            <th style="width: 35.6028%;">Date</th>     
                            <th style="width: 35.6028%;">Uploader</th>                               
                        </tr>
                        @forelse ($lup->lupfile->where('is_evidence',false) as $index=>$attachment)
                            <tr>
                            <td style="width: 5%;"><small>{{ $index +1 }}</small></td>
                            <td style="width: 80%;"><small>{{ $attachment->document_name }}</small></td>
                            <td style="width: 10%;"><small>{{ $attachment->uploader }}</small></td>    
                            <td style="width: 10%;"><small>@date($attachment->date_upload,'d-M-y')</small></td>                              
                            </tr>
                        @empty                
                        @endforelse            
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif	
</tbody>
</table>
</div>
<div class="page-break"></div>
<div name="categorization">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
	<tbody>
	<tr style="height: 18px; border-style: none;">
		<td style="height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="2"><strong>II. Categorization</strong></td>
		<td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="5"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>
	</tr>    
    <tr style="height: 18px; border-style: none;">
		<td style="width: 80%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Product/Material Quality Impact</small></strong></td>
		<td style="width: 3%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 10%; height: 18px; border-style: none; vertical-align: top;{{ $lup->product_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->product_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 80%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Patient Safety Impact</small></strong></td>
		<td style="width: 3%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 10%; height: 18px; border-style: none; vertical-align: top; {{ $lup->patient_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->patient_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Facilities Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->facilities_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->facilities_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Data Integrity Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->integrity_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->integrity_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Equipment/Utilities Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->equipment_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->equipment_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Environment Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->environment_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->environment_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Product Contact Equip Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->productcontact_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->productcontact_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Health & Safety Impact </small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->health_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->health_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Decomission Equip</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->decomission_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->decomission_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Computer System Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->computer_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->computer_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Calibration/Maintenance Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->maintenance_impact===1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->maintenance_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Product/Material Supply Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->supply_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->supply_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>GXP/Compliance Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->compliance_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->compliance_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Validation/Quality Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->validation_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->validation_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Regulatory Impact</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;{{ $lup->regulatory_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->regulatory_impact==1 ? 'Yes' : 'No'}}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Product Stability Impact</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;{{ $lup->stability_impact==1 ? 'color:rgb(240, 11, 11)' : ''}}"><small>{{ $lup->stability_impact==1 ? 'Yes' : 'No'}}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Categorization</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top;{{ $lup->categorization=='Minor' ? '' : 'color:rgb(240, 11, 11)'}}" colspan="5"><strong><small>{{$lup->categorization}}&nbsp;</small></strong></td>
	</tr>
    <tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Risk Assestment</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{!! $lup->risk_assestment !!}</small></td>
	</tr>
</tbody>
</table>
</div>

<div name="review">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
	<tbody>
	<tr style="height: 18px; border-style: none;">
		<td style="height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="2"><strong>III. Review & Comments</strong></td>	
        <td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="5"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>	
	</tr>   
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>a. External Parties</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->external_party_name }}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>External Party Name</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->external_party_name }}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_external_party }}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>b. Department Head of Inisiator </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Review by</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->leader ? $lup->leaders->name : '' }}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datesign_leader,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_leader }}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>c. Quality Compliance  </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Review by QSE</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->reviewer ? $lup->reviewers->name : '' }}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datesubmit_reviewer2,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_reviewer }}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Review by Q.Comp Jr. Manager</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->reviewer2 ? $lup->reviewerqcjms->name : '' }}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datesubmit_approver,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_reviewer2 }}</small></td>
	</tr>
	</tbody>
	</table>

	<div class="page-break"></div>
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
		<tbody>
		<tr style="height: 18px; border-style: none;">
			<td style="height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="2"><strong>III. Review & Comments</strong></td>	
			<td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="5"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>	
		</tr>  
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>d. Related Department  </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    @forelse ($lup->relateddepartment as $index=>$relateddepartment)
        <tr style="height: 36px; border-style: none;margin-top:1px;">
            <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
            <td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>{{$index+1}}. {{$relateddepartment->department}}</small></strong></td>
            <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
            <td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$relateddepartment->user->name}}</small></td>
            <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
            <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
            <td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($relateddepartment->signdate,'d-M-y')</small></td>
        </tr>
        <tr style="height: 36px; border-style: none;margin-top:1px;">
            <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
            <td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
            <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
            <td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $relateddepartment->note }}</small></td>
        </tr>
    @empty        
    @endforelse
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>e. Regulatory  </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Regulatory Change Type</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->regulatory_change_type}}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Regulatory Variation</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>{{$lup->regulatory_variation}}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Review by Regulatory</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->regulatory_reviewer ? $lup->regulatory_reviewers->name : '' }}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datesubmit_regulatory_approver,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_regulatory_reviewer }}</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Approved by Regulatory</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->regulatory_approver ? $lup->regulatory_approvers->name : '' }}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datesign_regulatory_approver,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_regulatory_approver }}</small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>f. Final Approval  </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>       
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>QA/Q.Compliance   </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>   
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Approved by</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->approver ? $lup->approvers->name : ''}}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->dateapproved,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_approver }}</small></td>
	</tr>    
</tbody>
</table>
</div> 

<div class="page-break"></div>
<div name="action">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
	<tbody>
	<tr style="height: 18px; border-style: none;">
		<td style="height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="2"><strong>IV. Action Plan</strong></td>	
        <td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="5"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>	
	</tr>   
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>Action(s) Required : {{$lup->lupaction->count()>0 ? 'Yes':'No'}}</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;" colspan="7"><strong><small>Justification (If No action plan needed) : {{$lup->action_notes}}</small></strong></td>		
	</tr>
    @if($lup->lupaction->count() > 0)
        <tr style="height: 36px; border-style: none;">
            <td style="width: 100%; height: 36px; border-style: none; vertical-align: top;" colspan="7">
                <div name="action">
                    <table style="width: 100%; border-collapse: collapse; " border="1">
                        <tbody>
							<tr style="background-color: #0072e5;  color:#ffffff">
								<th style="width: 4.39716%;">No</th>
								<th style="width: 35.6028%;">Description</th>
								<th style="width: 20%;">Department</th>                            
								<th style="width: 20%;">Due Date</th>
								<th style="width: 20%;">PIC</th>                            
								<th style="width: 20%;">Date Closed</th>								
							</tr>
							@forelse ($lup->lupaction as $index=>$lupaction)
							<tr>
								<td style="width: 5%;"><small>{{ $index +1 }}</small></td>
								<td style="width: 35%;"><small>{{ $lupaction->action }}</small></td>
								<td style="width: 25%;">{{ $lupaction->pic->department }}</td>                            
								<td style="width: 5%; text-align:center;"><small>@date($lupaction->duedate_action,'d-M-y')</small></td>
								<td style="width: 25%;"><small>{{ $lupaction->pic->name }}</small></td>
								<td style="width: 5%;text-align:center;"><small>@date($lupaction->dateapproved_evidence,'d-M-y')</small></td>								
							</tr>
							@empty
								
							@endforelse
                        
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif
    <tr style="height: 18px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" colspan="7"><small></small></td>		
	</tr>
	<tr style="height: 36px; border-style: none;margin-top:1px;">           
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"colspan="2"><strong><small>Proposed Change Notify To </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 100%; height: 18px; border-style: none; vertical-align: top; text-align:left;" colspan="4"><small>{{$lup->action_notifier}}</small></td>
	</tr>


    <tr style="height: 36px; border-style: none;margin-top:1px;">           
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"colspan="2"><strong><small>Action Plan Approval</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>QA/Q.Compliance </small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Approved by</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{$lup->confirmer ? $lup->confirmers->name : ''}}</small></td>
        <td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->dateconfirmed,'d-M-y')</small></td>
	</tr>
    <tr style="height: 36px; border-style: none;margin-top:1px;">
        <td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->note_confirmer }}</small></td>
	</tr>
</tbody>
</table>
</div>
<div name="closing">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
		<tbody>
			<tr style="height: 18px; border-style: none;">
				<td style="height: 18px;width: 50%; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="3"><strong>V. Closing Change Control Verification and Approval </strong></td>	
				<td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="4"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>	
			</tr>   
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>Verification</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="4"><strong><small>a. All Necessary Documents already created/revised </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="1"><small>{{ $lup->verified_a }}</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"colspan="4"><strong><small>b. All The Proposed Measured has been implemented  </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="1"><small>{{ $lup->verified_b }}</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"colspan="4"><strong><small>c. Notification Letter / Submission / Approval from Regulatory Authority</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="1"><small>{{ $lup->verified_c }}</small></td>
			</tr>
			<tr style="height: 36px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->closing_notes }}</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><strong><small>Closing Verified by Quality System Executive</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>				
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Name </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->reviewer_closing }}</small></td>
				<td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->dateclosing_reviewer,'d-M-y')</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><strong><small>Approved by QA/Q.Compliance Jr Manager/Manager/Senior Manager </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" ><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>				
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Name </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->approver_closing }}</small></td>
				<td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->dateclosing_approver,'d-M-y')</small></td>
			</tr>
			<tr style="height: 36px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->approverclosing_notes }}</small></td>
			</tr>
		</tbody>
	</table>
</div>
<div name="cancel">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
		<tbody>
			<tr style="height: 18px; border-style: none;">
				<td style="height: 18px; border-bottom: double;background-color: #004890;  color:#ffffff" colspan="3"><strong>VI. Cancelation Request</strong></td>	
				<td style="height: 18px; border-bottom: double; text-align:right;background-color: #004890;  color:#ffffff" colspan="4"><small># {{ $lup->code}} | No : {{ $lup->nolup}} | Rev : {{ $lup->revision }} | Status : {{ $lup->lupstatus }}</td>	
			</tr>   
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="2"><strong><small>Requested by</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>				
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Name </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->cancel_requester }}</small></td>
				<td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datecancel_request,'d-M-y')</small></td>
			</tr>
			<tr style="height: 36px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Cancellation Justification</small></strong></td>
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->cancel_notes }}</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><strong><small>Verified by Quality System Executive</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>				
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Verified by </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->cancel_reviewer }}</small></td>
				<td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datecancel_reviewed,'d-M-y')</small></td>
			</tr>
			<tr style="height: 18px; border-style: none;">
				<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><strong><small>Approved by QA/Q.Compliance Jr Manager/Manager/Senior Manager </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:justify;" ><small></small></td>
			</tr>
			<tr style="height: 18px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small></small></td>				
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Approved by </small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 50%; height: 18px; border-style: none; vertical-align: top; text-align:justify;"><small>{{ $lup->cancel_approver }}</small></td>
				<td style="width: 15%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Date</small></strong></td>
				<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top; text-align:right;"><small>@date($lup->datecancel_approved,'d-M-y')</small></td>
			</tr>
			<tr style="height: 36px; border-style: none;margin-top:1px;">
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small></small></td>
				<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Comments</small></strong></td>
				<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
				<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="4"><small>{{ $lup->approvercancel_notes }}</small></td>
			</tr>
		</tbody>
	</table>
</div>


<div class="footer">	    
	<table style="width: 100%; height: 50px;">        
		<tbody>
		<tr style="height: 18px;">
		<td style="width: 35%; height: 18px; border-bottom: double; " colspan="2"><strong>Print by : {{ $printby }}</strong></td>        
		<td style="width: 50%; height: 18px; border-bottom: double; text-align:right;" colspan="2"><strong>Print Date : @date($printdate,'d-M-y')</strong></td>		
		</tr>	
		</tbody>
	</table>
</div>	
<script type="text/php">
    if ( isset($pdf) ) {
        $font = $fontMetrics->getFont("helvetica", "bold");
        $pdf->page_text(525, 825, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
    }
</script> 
</body>

</html>
