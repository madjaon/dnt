@if($data && count($postData) > 0)
<div class="related">
	<div class="box-title clearfix">
		<h3><a href="{{ $typeMainUrl }}" title="{!! $data->name !!}">{!! $data->name !!}</a></h3>
	</div>
	@if(isset($isProduct) && $isProduct == true)
		@include('site.post.boxGrid', array('data' => $postData))
	@else
		@include('site.post.boxMix', array('data' => $postData))
	@endif
</div>
@endif
