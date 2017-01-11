@if(isset($isCreate))
<div class="product-area">
	<div class="form-group">
		<label>Giá</label>
		<p>ex: 5000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="price" type="text" value="{{ old('price') }}" class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Giá cũ</label>
		<p>Nếu có khuyến mại. ex: 4000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="price_old" type="text" value="{{ old('price_old') }}" class="form-control">
			</div>
		</div>
	</div>
	<!-- <div class="form-group">
		<label>Chiết khấu / Giảm giá</label>
		<p>ex: 20% hoặc 1000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="discount" type="text" value="{{-- old('discount') --}}" class="form-control">
			</div>
		</div>
	</div> -->
	@include('admin.post.postimage', array('isCreate' => true))
</div>
@elseif(isset($isEdit))
<div class="product-area">
	<div class="form-group">
		<label>Giá</label>
		<p>ex: 5000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="price" type="text" value="{{ $data->price }}" class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Giá cũ</label>
		<p>Nếu có khuyến mại</p>
		<p>Nếu có khuyến mại. ex: 4000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="price_old" type="text" value="{{ $data->price_old }}" class="form-control">
			</div>
		</div>
	</div>
	<!-- <div class="form-group">
		<label>Chiết khấu / Giảm giá</label>
		<p>ex: 20% hoặc 1000000 . Bỏ trống nếu không có</p>
		<div class="row">
			<div class="col-sm-12">
				<input name="discount" type="text" value="{{-- $data->discount --}}" class="form-control">
			</div>
		</div>
	</div> -->
	@include('admin.post.postimage', array('isEdit' => true, 'data' => $data))
</div>
@endif
<script>
	$('select[name="type"]').on('change', function () {
	  var value = $(this).val();
	  var type = {{ PRODUCT }};
	  if (value == type) {
	    $('.product-area').css('display', 'inline-block');
	  } else {
	    $('.product-area').css('display', 'none');
	  }
	}).trigger('change');
</script>