<?php $device = getDevice2(); ?>
@if($device != MOBILE)
<div class="side">
	<div class="search">
		<div class="row column">
			<form action="{{ route('site.search') }}" method="GET" class="search-form">
				<div class="input-group">
					<input name="name" type="text" value="" class="input-group-field" id="searchtext" placeholder="Tìm kiếm">
					<div class="input-group-button">
						<a class="button" onclick="$('.search-form').submit()"><i class="fa fa-search" aria-hidden="true"></i></a>
					</div>
				</div>
	        </form>
		</div>
	</div>
</div>
@endif
@if(!isset($isHome) || $isHome !== true)
<div class="side hotline">
	<strong><i class="fa fa-phone" aria-hidden="true"></i> Tư vấn nhanh</strong>
	<div class="hotcall">{!! CommonMethod::genHotline($confighotline, 2) !!}</div>
</div>
@endif
@include('site.common.ad', ['posPc' => 5, 'posMobile' => 6])
<div class="side marginbot">
	<strong>Danh mục sản phẩm</strong>
	<div class="sidemenu">{!! $sidemenu !!}</div>
</div>
@if(!empty($populararchives))
<div class="side marginbot">
	<strong>Bài đọc nhiều</strong>
	<ul class="archives">
	@foreach($populararchives as $key => $value)
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
@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])
