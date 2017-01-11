<div class="bottomarea">
	<div class="row">
		<div class="medium-4 columns">
			@if(!empty($productpopular))
			<strong>Sản phẩm xem nhiều</strong>
			<div class="area">
				<ul class="archives">
				@foreach($productpopular as $key => $value)
				<?php 
					if(!empty($value->image)) {
						$image = str_replace('/images/', '/thumbs/', $value->image);
						$image = str_replace('/thumb/', '/', $image);
					} else {
						$image = '/img/noimage.jpg';
					}
				?>
					<li>
						<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
							<img src="{{ $image }}" alt="{!! $value->name !!}" />
							<span>{!! $value->name !!}</span>
						</a>
					</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
		<div class="medium-4 columns">
			<strong>Danh mục</strong>
			<div class="bottommenu">{!! $bottommenu !!}</div>
		</div>
		<div class="medium-4 columns">
			<strong>Thông tin liên hệ</strong>
			@if(!empty($configaddress))
			<div class="address">{!! $configaddress !!}</div>
			@endif
			@if(!empty($configfbpage))
			<div class="fbpage">
				<div class="fb-page" data-href="{!! $configfbpage !!}" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"></div>
			</div>
			@endif
		</div>
	</div>
</div>