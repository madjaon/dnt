<?php 
	$device = getDevice2();
	$countPost = count($post);
	if($countPost > 0) {
		$title = ($post->meta_title!='')?$post->meta_title:$post->name;
		$h1 = $post->name;
		$isPost = true;
		$isProduct = true;
		$is404 = false;
		$meta_title = $post->meta_title;
		$meta_keyword = $post->meta_keyword;
		$meta_description = $post->meta_description;
		$meta_image = $post->meta_image;
	} else {
		$title = PAGENOTFOUND;
		$h1 = PAGENOTFOUND;
		$isPost = false;
		$isProduct = false;
		$is404 = true;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'isPost' => $isPost,
			'isProduct' => $isProduct,
			'is404' => $is404,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box detail">
	<?php
		if(isset($typeMainParent)) {
			$typeMainParentUrl = url($typeMainParent->slug);
			$typeMainUrl = url($typeMainParent->slug.'/'.$typeMain->slug);
			$breadcrumb = array(
				['name' => $typeMainParent->name, 'link' => $typeMainParentUrl],
				['name' => $typeMain->name, 'link' => $typeMainUrl],
				['name' => $h1, 'link' => '']
			);
		} else {
			$typeMainUrl =url($typeMain->slug);
			$breadcrumb = array(
				['name' => $typeMain->name, 'link' => $typeMainUrl],
				['name' => $h1, 'link' => '']
			);
		}
	?>
	@include('site.common.breadcrumb', $breadcrumb)
	<div class="row">
		<div class="medium-6 columns">
			@include('site.post.detailimage', ['post' => $post])
		</div>
		<div class="medium-6 columns">
			<div class="title">
				<h1>{!! $h1 !!}</h1>
			</div>
			<div class="shop">
				@if(!empty($post->price))
					<p>
						<strong>{!! CommonMethod::getFullPriceInVnd($post->price) !!}</strong>
						@if(!empty($post->price_old))
							<span>{!! CommonMethod::getFullPriceInVnd($post->price_old) !!}</span>
						@endif
					</p>
					<!-- @if(!empty($post->discount))
						<p>Giảm {!! $post->discount !!}</p>
					@endif -->
				@else
					<p class="label warning">Liên hệ để biết giá</p>
				@endif
			</div>
			<div class="contactme">
				<p><a class="savelove" onclick="makelove({{ $post->id }});" rel="nofollow"><i class="fa fa-heart" aria-hidden="true"></i> Thêm vào danh sách yêu thích <span class="msglove msglove{{ $post->id }}">Đã Thêm</span></a></p>
				<p><span class="label primary">Tư Vấn &amp; Đặt Hàng</span></p>
				@if($confighotline)<p class="callnow"><i class="fa fa-phone" aria-hidden="true"></i> Gọi ngay: {!! CommonMethod::genHotline($confighotline) !!}</p>@endif
				<!-- <form method="post" class="ordernow" id="ordernow">
					<fieldset>
						<legend>Đặt hàng nhanh</legend>
						<input type="hidden" name="id" value="{{ $post->id }}" />
						<p><label>Họ tên</label><input type="text" name="name" required="" maxlength="255" /></p>
						<p><label>Email</label><input type="email" name="email" required="" maxlength="255" /></p>
						<p><label>Điện thoại</label><input type="text" name="tel" required="" maxlength="255" /></p>
						<input type="button" value="Đặt Hàng Ngay" onclick="ordernow();" />
					</fieldset>
				</form> -->
			</div>
		</div>
	</div>
	
	<div class="info">
		<div class="description">{!! $post->description !!}</div>
		
		@include('site.common.social')
		
		@if(count($tags) > 0)
		<div class="tags">
			<div class="tags-icon"><i class="fa fa-tags" aria-hidden="true"></i> Chuyên mục</div>
			<ul>
				@foreach($tags as $value)
				<li><a href="{{ url('tag/'.$value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></li>
				@endforeach
			</ul>
		</div>
		@endif

		<div class="fb-comments" data-numposts="5"></div>

		@include('site.post.related', ['typeMainUrl' => $typeMainUrl, 'data' => $typeMain, 'postData' => $postTypes])
		@include('site.post.related', ['typeMainUrl' => $typeMainUrl, 'data' => $related, 'postData' => $postRelated])
	</div>
</div>
@endsection