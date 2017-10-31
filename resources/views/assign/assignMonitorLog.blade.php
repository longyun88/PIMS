@foreach($datas as $data)
<div class="infoRow">

	<span class="infoITEM info_s"> {{ $data['id'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['sort'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['type'] or '' }} </span>
	<span class="infoITEM info_l"> {{ $data['name'] or '' }} </span>
	<span class="infoITEM info_xl"> {{ $data['realname'] or '' }} </span>
	<span class="infoITEM info_l"> {{ $data['lastShow'] or '' }} </span>
	<span class="infoITEM info_s"> {{ $data['log'] or '' }} </span>
	<span class="infoITEM info_m"> {{ $data['ip'] or '' }} </span>
	<span class="infoITEM info_l"> {{ $data['registerShow'] or '' }} </span>

</div>
@endforeach