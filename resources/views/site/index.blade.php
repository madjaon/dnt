<?php 
	if(isset($seo)) {
		$title = ($seo->meta_title)?$seo->meta_title:'Trang chủ';
		$meta_title = $seo->meta_title;
		$meta_keyword = $seo->meta_keyword;
		$meta_description = $seo->meta_description;
		$meta_image = $seo->meta_image;
		$isHome = true;
		$is404 = false;
	} else {
		$title = PAGENOTFOUND;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
		$isHome = false;
		$is404 = true;
	}
	$extendData = array(
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'isHome' => $isHome,
			'is404' => $is404,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
@if(count($data) > 0)
	@foreach($data as $key => $value)
		@if(count($value->posts) > 0)
			<?php 
				if($value->parentType) {
					$url = url($value->parentType->slug.'/'.$value->slug);
				} else {
					$url = url($value->slug);
				}
			?>
			<div class="box">
				<div class="box-title clearfix">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h3>
				</div>
				@if($value->grid == ACTIVE)
					@include('site.post.boxList', array('type' => $value))
				@else
					@include('site.post.boxGrid', array('type' => $value))
				@endif
				<div class="box-seemore">
					<a href="{{ $url }}" title="{!! $value->name !!}">Xem thêm</a>
				</div>
			</div>
			<div class="clearfix"></div>
		@endif
	@endforeach
@endif

@endsection