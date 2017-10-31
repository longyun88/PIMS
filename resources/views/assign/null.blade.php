


		<!--引用 附图 Quote.Attaching-->
		<div class="_itemR _itemRO attaching-Box {{ $data['origin']['attachingIS'] or '' }} {{ $data['originIS'] or '' }}">
			<div class="item-attaching item-attaching{{ $data['origin']['attaching_styleNum'] or '' }}">
				@forelse($data['origin']['originAttaching'] as $attachingO)
				<span class="_attachingPiece attachingShowImage{{ $data['origin']['attachingShowerClick'] or '' }}">
					<img src="{{ $attachingO or '' }}" />
				</span>
				@empty
				@endforelse
			</div>
		</div>

