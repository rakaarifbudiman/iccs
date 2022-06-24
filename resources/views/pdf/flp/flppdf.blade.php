<!DOCTYPE html>
<html>
<head>	
	@if (!$flp->noflp)
		<title>{{ $flp->code }}</title>
	@else
		<title>{{ $flp->noflp }}</title>
	@endif
	<title>{{ $flp->noflp }}</title>
	<style>
		*{
			font-size: 12px;
		}
		@page { 
			margin-top: 0cm;
			margin-bottom: 0cm;
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

		.flex-container > div {
		background-color: #f1f1f1;		
		text-align: center;		
		font-size: 12px;
		}
	</style>
</head>
<body>
	<header>
		<img style="float: left; height: 50px; margin-top: 15px;" src="assets/img/logo-sgh.PNG" />
		<p style="text-align: right;"><small>Lampiran D&nbsp;<br />FM11-PSM01/04<br />Rev.03</small></p>
		
		<table style="height: 10px; width: 100%; border-collapse: collapse;" border="1">
		<tbody>
		<tr style="height: 10px;">
		<td style="width: 100%; height: 10px;">
		<p style="text-align: center; padding-top: 0px; font-size: 16;"> 
			<strong>Form Launching Product (FLP)</strong><br><strong>{{ $flp->noflp }}</strong></p>			
		</td>
		</tr>
		</tbody>
		</table>
	</header>
<p style="clear:both"></p>
<div name="details">
	<table style="height: 127px; width: 100.553%; border-collapse: collapse; vertical-align: top; margin-top:10px">
	<tbody>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32.4514%; height: 18px; border-bottom: double;" colspan="5"><strong>Details</strong></td>
		<td style="width: 32.4514%; height: 18px; border-bottom: double; text-align:right" colspan="2"><small>Created Date : @date($flp->date_input,'d-M-y') | Rev.{{ $flp->revision }}</td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Product Name</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 25.1484%; height: 18px; border-style: none; vertical-align: top;" colspan="5"><small>{{ $flp->documentname}}&nbsp;</small></td>
	</tr>
	<tr style="height: 36px; border-style: none;">
		<td style="width: 32%; height: 36px; border-style: none; vertical-align: top;"><strong><small>Active Ingredients</small></strong></td>
		<td style="width: 3.1746%; height: 36px; border-style: none; vertical-align: top;" ><small>:</small></td>
		<td style="width: 25.1484%; height: 36px; border-style: none; vertical-align: top; text-align:justify;" colspan="5"><small>{{ $flp->ingredients }}</small></td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32.4514%; height: 18px;" colspan="7"></td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;" ><strong><small>Bussiness Unit</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $flp->bussinessunit }}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Packaging</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $flp->packaging }}</small></td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Registration No.</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $flp->regno }}</small></td>
		<td style="width: 1.5%; height: 18px; border-style: none; vertical-align: top;">&nbsp;</td>
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>HET</small></strong></td>
		<td style="width: 2.21212%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 18px; border-style: none; vertical-align: top;"><small>{{ $flp->het }}</small></td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 18px; border-style: none; vertical-align: top;"><strong><small>Target Launch</small></strong></td>
		<td style="width: 3.1746%; height: 18px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 50%; height: 18px; border-style: none; vertical-align: top;"><small>@date($flp->launch,'d-M-y')</small></td>
	</tr>
	<tr style="height: 18px; border-style: none;">
		<td style="width: 32%; height: 37px; border-style: none; vertical-align: top;"><strong><small>Notes</small></strong></td>
		<td style="width: 2.21212%; height: 37px; border-style: none; vertical-align: top;"><small>:</small></td>
		<td style="width: 47.2314%; height: 37px; border-style: none; vertical-align: top;" colspan="5"><small>{{ $flp->notes }}</small></td>
	</tr>
	</tbody>
	</table>
</div>

<div name="actionplan">
	<table style="width: 100%; border-collapse: collapse; " border="1">
		<tbody>
		<tr style="background-color: #444444;  color:white">
			<th style="width: 4.39716%;">No</th>
			<th style="width: 35.6028%;">Action Plan</th>
			<th style="width: 20%;">PIC Name</th>
			<th style="width: 20%;">Due Date</th>
			<th style="width: 20%;">Department</th>
			<th style="width: 20%;">Sign Date</th>
		</tr>
		@forelse ($flpactions as $index=>$flpaction)
			<tr>
			<td style="width: 5%;"><small>{{ $index +1 }}</small></td>
			<td style="width: 35%;"><small>{{ $flpaction->action }}</small></td>
			<td style="width: 25%;"><small>{{ $flpaction->pic_name }}</small></td>
			<td style="width: 5%;"><small>@date($flpaction->duedate_action,'d-M-y')</small></td>
			<td style="width: 25%;">{{ $flpaction->pic_dept }}</td>
			<td style="width: 5%;"><small>@date($flpaction->signdate_action,'d-M-y')</small></td>
			</tr>
		@empty
			
		@endforelse
		
		</tbody>
	</table>
</div>

<div class="footer">
	<table style="width: 100%; height: 72px;">
		<tbody>
		<tr style="height: 18px;">
		<td style="width: 20.1536%; height: 36px; border-bottom: double; " colspan="2"><strong>Proposed by : {{ $flp->deptinisiator }}</strong></td>
		<td style="width: 35.7564%; height: 36px; border-bottom: double; text-align:center;" colspan="2"><strong>Review by : {{ $flp->deptreviewer }}</strong></td>
		<td style="width: 22.2222%; height: 36px; text-align:right; border-bottom: double; " colspan="2"><strong>Approved by : {{ $flp->deptapprover }}</strong></td>

		</tr>
		<tr style="height: 18px;">		
		<td style="width: 30%; height: 18px;"  colspan="2">{{ $flp->inisiator }} | @date($flp->datesign_inisiator,'d-M-y')</td>
		<td style="width: 18.0259%; height: 36px; vertical-align: top; text-align:center;" colspan="2" rowspan="2">{{ $flp->reviewer }} | @date($flp->datesubmit_approver,'d-M-y')</td>
		<td style="width: 11.1111%; height: 36px; vertical-align: top; text-align:right;" colspan="2" rowspan="2">{{ $flp->approver }} | @date($flp->dateapproved,'d-M-y')</td>

		</tr>
		<tr style="height: 18px;">		
		<td style="width: 30%; height: 18px;"  colspan="2">{{ $flp->leader }} | @date($flp->datesign_leader,'d-M-y')</td>

		</tr>
		</tbody>
		</table>
</div>
</body>

</html>
