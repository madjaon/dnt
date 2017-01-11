<?php 
	$data = Cart::content();
?>
@if(count($data) > 0)
<div class="box-list box-mix">
	<strong>Sản phẩm yêu thích</strong>
	<div class="row small-up-1 medium-up-3 large-up-3">
		@foreach($data as $key => $value)
		<?php 
			if($value->options->image) {
				$image = str_replace('/images/', '/thumbs/', $value->options->image);
				$image = str_replace('/thumb/', '/', $image);
			} else {
				$image = '/img/noimage.jpg';
			}
		?>
		<div class="column">
			<div class="row">
				<div class="small-4 columns">
					<a href="{{ url($value->options->slug) }}" title="{!! $value->name !!}" class="list-image">
						<img src="{{ $image }}" alt="{!! $value->name !!}" />
					</a>
				</div>
				<div class="small-8 columns">
					<div class="list-content">
						<h2><a href="{{ url($value->options->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
						<div class="list-price">
							@if(!empty($value->price))
								<p>
									<strong>{!! CommonMethod::getFullPriceInVnd($value->price) !!}</strong>
									@if(!empty($value->options->price_old))
										<span>{!! CommonMethod::getFullPriceInVnd($value->options->price_old) !!}</span>
									@endif
								</p>
								<!-- @if(!empty($value->options->discount))
									<p>Giảm {!! $value->options->discount !!}</p>
								@endif -->
							@else
								<p>Liên hệ để biết giá</p>
							@endif
						</div>
						<a class="unlove" onclick="unlove('{{ $value->rowId }}');" title="Xóa khỏi danh sách yêu thích"><i class="fa fa-times" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="medium-12 columns"><div class="divider"></div></div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endif