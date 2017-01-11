<?php 
	if(isset($type) && isset($type->posts)) {
		$data = $type->posts;
	}
?>
<div class="box-grid">
	<div class="row small-up-2 medium-up-3 large-up-3">
		@foreach($data as $key => $value)
		<?php 
			if(isset($type) && isset($value->parent_id)) {
				$url = url($type->slug.'/'.$value->slug);
			} else {
				$url = url($value->slug);
			}
			$image = ($value->image)?$value->image:'/img/noimage.jpg';
		?>
		<div class="column">
			<div class="callout clearfix">
				<div class="grid-image">
					<a href="{{ $url }}" title="{!! $value->name !!}">
						<img src="{{ $image }}" alt="{!! $value->name !!}" />
					</a>
					<span class="makelove" onclick="makelove({{ $value->id }});" title="Yêu thích"></span>
					<span class="overlay"></span>
					<span class="msglove msglove{{ $value->id }}">Đã Thêm</span>
					<a href="{{ $url }}" title="{!! $value->name !!}" class="viewdetail">Xem chi tiết</a>
				</div>
				<div class="grid-title">
					<h2><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				</div>
				@if($value->type == PRODUCT)
				<div class="grid-price">
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
				@endif
			</div>
		</div>
		@endforeach
	</div>
</div>