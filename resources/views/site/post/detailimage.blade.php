@if(!empty($post) && !empty($post->post_images))
<?php 
	$post_images = explode(',', $post->post_images);
	$count_post_images = count($post_images);
?>
<div class="detail-image">
	<ul id="etalage">
		@foreach($post_images as $key => $value)
		<li>
			<img class="etalage_source_image" src="{{ $value }}" title="" />
			<!-- <p>{!! $post->name !!}</p> -->
		</li>
		@endforeach
	</ul>
<!--                                <div class="etalage-control">
		<a class="etalage-prev" href="javascript:void(0)"><i class="icon-angle-left"></i></a>
		<a class="etalage-next" href="javascript:void(0)"><i class="icon-angle-right"></i></a>
	</div>-->
	<div class="clearfix"></div>
</div>
@endif