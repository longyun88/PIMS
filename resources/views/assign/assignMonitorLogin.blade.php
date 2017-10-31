@foreach($datas as $data)
<div class="infoRow">

	<span class="infoITEM info_s"> {{ $data['id'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['sort'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['type'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['belongId'] or '' }} </span>
	<span class="infoITEM info_l"> {{ $data['name'] or '' }} </span>
	<span class="infoITEM info_l"> {{ $data['timeShow'] or '' }} </span>
	<span class="infoITEM info_m"> {{ $data['ip'] or '' }} </span>

</div>
@endforeach