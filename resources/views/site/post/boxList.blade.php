<?php 
	if(isset($type) && isset($type->posts)) {
		$data = $type->posts;
	}
?>
<div class="box-list">
	@foreach($data as $key => $value)
	<?php 
		if(isset($type) && isset($value->parent_id)) {
			$url = url($type->slug.'/'.$value->slug);
		} else {
			$url = url($value->slug);
		}
		$image = ($value->image)?$value->image:'/img/noimage.jpg';
	?>
	<div class="row">
		<div class="medium-4 columns">
			<a href="{{ $url }}" title="{!! $value->name !!}" class="list-image">
				<img src="{{ $image }}" alt="{!! $value->name !!}" />
			</a>
		</div>
		<div class="medium-8 columns">
			<div class="list-content">
				<h2><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				@if($value->type == PRODUCT)
					<div class="list-price">
						@if(!empty($value->price))
							<p>
								<strong>{!! CommonMethod::getFullPriceInVnd($value->price) !!}</strong>
								@if(!empty($value->price_old))
									<span>{!! CommonMethod::getFullPriceInVnd($value->price_old) !!}</span>
								@endif
							</p>
							<!-- @if(!empty($value->discount))
								<p>Giảm {!! $value->discount !!}</p>
							@endif -->
						@else
							<p>Liên hệ để biết giá</p>
						@endif
					</div>
				@else
					@if($value->summary != '')
						<p>{!! limit_text($value->summary, 1000) !!}</p>
					@else
						<p>{!! limit_text(strip_tags($value->description), 1000) !!}</p>
					@endif
				@endif
			</div>
		</div>
		<div class="medium-12 columns"><div class="divider"></div></div>
	</div>
	@endforeach
</div>