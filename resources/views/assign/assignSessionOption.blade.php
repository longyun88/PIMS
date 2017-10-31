@foreach($datas as $data)
<div class="_pointer _piece list-option selector cilckerbacks session-option-ctrl {{ $data['controller'] or '' }}"
    id="session-{{ $data['ctrl'] or '' }}" data-checked="0"
    data-update="init"
    data-db="{{ $data['belongDB'] or '' }}"
    data-id="{{ $data['id'] or '' }}"
    data-sort="{{ $data['sort'] or '' }}"
    data-type="{{ $data['type'] or '' }}"
    data-belong="{{ $data['belong'] or '' }}"
    data-item="{{ $data['item'] or '' }}"
    data-userItemId="{{ $data['userItemId'] or '' }}"
    data-workingId="{{ $data['ctrl'] or '' }}"
    data-ctrl="{{ $data['ctrl'] or '' }}"
    data-session_type="{{ $data['session_type'] or '' }}"
	data-selector=".session-ctrl" 
	data-selected="list-selected" 
	data-cilckerback="#session-session" 
>
	
	<span class="p-leftop1 _box1 _f12 _bold _cfff _bgred _alert session-alert {{ $data['unread_isset'] or '' }}"> {{ $data['unreadNum'] or '' }} </span>

	<div class="btn-hover piece-portrait whoss" data-whos="{{ $data['belong'] or '' }}" title="进入TA的主页">
		<img src="./images/portrait/user{{ $data['belong'] or '' }}.jpg?{{ $data['random'] or '' }}">
	</div>
	
	<div class="piece-entity">
		<div class="piece-row piece-top session-top"><span class="_f14 _bold session-title"> {{ $data['header'] or '' }} </span></div>
		<div class="piece-row piece-bottom session-bottom"><span class="_f12 session-theme">{{ $data['theme'] or '' }}</span></div>
	</div>
	
	<div class="piece-tools">
		<span class="piece-tool session-option-close _f16 _bold"> <em class="iconer closer-icon"></em> </span>
	</div>

</div>
@endforeach



