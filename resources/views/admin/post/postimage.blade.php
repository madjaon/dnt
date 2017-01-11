@if(isset($isCreate))
<div class="box-body table-responsive no-padding">
	<label>Ảnh (sản phẩm) / <span id="postimage_num">0</span> ảnh</label>
	<p>Kích thước: 1000x1000. Định dạng jpg, jpeg, png. Tên thư mục & ảnh phải là không dấu, không chứa dấu cách + kí tự đặc biệt. Dung lượng ảnh nhẹ (< 1mb)<br>Auto crop thumbnail: 400x400</p>
	<div class="overflow-box postimage">
		<ul id="ul_images">
			<li id="li_images_0">
				<input name="post_images[]" type="hidden" value="" id="post_images_0" onchange="GetFilenameFromPathPostImage('post_images_0');" />
				<img src="" class="post_images_0" />
				<a href="/adminlte/plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=post_images_0&akey={{ AKEY }}" class="iframe-btn postimage-btn">Chọn hình</a>
				<a onclick="deleteImage('li_images_0');" class="postimage-delete">Xóa</a>
			</li>
		</ul>
	</div>
</div>
@elseif(isset($isEdit))
<?php 
	if($data->post_images != '') {
		$post_images = explode(',', $data->post_images);
		$count_post_images = count($post_images);
	} else {
		$count_post_images = 0;
	}
?>
<div class="box-body table-responsive no-padding">
	<label>Ảnh (sản phẩm) / <span id="postimage_num">{{ $count_post_images }}</span> ảnh</label>
	<p>Kích thước: 1000x1000. Định dạng jpg, jpeg, png. Tên thư mục & ảnh phải là không dấu, không chứa dấu cách + kí tự đặc biệt. Dung lượng ảnh nhẹ (< 1mb)<br>Auto crop thumbnail: 400x400</p>
	<div class="overflow-box postimage">
		<ul id="ul_images">
			@if($count_post_images > 0)
			@foreach($post_images as $key => $value)
			<li id="li_images_{{ $key }}">
				<input name="post_images[]" type="hidden" value="{{ $value }}" id="post_images_{{ $key }}" onchange="GetFilenameFromPathPostImage('post_images_{{ $key }}');" />
				<img src="{{ $value }}" class="post_images_{{ $key }}" />
				<a href="/adminlte/plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=post_images_{{ $key }}&akey={{ AKEY }}" class="iframe-btn postimage-btn">Chọn hình</a>
				<a onclick="deleteImage('li_images_{{ $key }}');" class="postimage-delete">Xóa</a>
			</li>
			@endforeach
			@endif
			<li id="li_images_{{ $count_post_images }}">
				<input name="post_images[]" type="hidden" value="" id="post_images_{{ $count_post_images }}" onchange="GetFilenameFromPathPostImage('post_images_{{ $count_post_images }}');" />
				<img src="" class="post_images_{{ $count_post_images }}" />
				<a href="/adminlte/plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=post_images_{{ $count_post_images }}&akey={{ AKEY }}" class="iframe-btn postimage-btn">Chọn hình</a>
				<a onclick="deleteImage('li_images_{{ $count_post_images }}');" class="postimage-delete">Xóa</a>
			</li>
		</ul>
	</div>
</div>
@endif

<script>
	function GetFilenameFromPathPostImage(id)
	{
	    var filePath = $('#'+id).val();
	    var first_url = filePath.substring(0,filePath.lastIndexOf("/")+1);
	    var last_url = filePath.substring(filePath.lastIndexOf("/")+1);
    	$('#'+id).val(first_url + last_url);
    	$('.'+id).prop('src', first_url + last_url);
    	//get last id
    	var last_li_id = $('#ul_images li:last-child').prop('id');
    	var last_num = getNum(last_li_id);
    	var next_num = last_num + 1;
    	var id_num = getNum(id);
    	if(id_num === last_num) {
    		addLi(next_num);
    	}
    	updateNum();
	}

	function deleteImage(id)
	{
		//get last id
		var last_li_id = $('#ul_images li:last-child').prop('id');
    	var last_num = getNum(last_li_id);
    	//get delete id
    	var id_num = getNum(id);
    	if(id_num !== last_num) {
    		$('#'+id).slideUp("normal", function() { $(this).remove(); } );
    		updateNum(true);
    	}
    	return;
	}
	function addLi(key)
	{
		var akey = "{{ AKEY }}";
		var li = '<li id="li_images_'+key+'"><input name="post_images[]" type="hidden" value="" id="post_images_'+key+'" onchange="GetFilenameFromPathPostImage(\'post_images_'+key+'\');" /><img src="" class="post_images_'+key+'" /><a href="/adminlte/plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=post_images_'+key+'&akey='+akey+'" class="iframe-btn postimage-btn">Chọn hình</a><a onclick="deleteImage(\'li_images_'+key+'\');" class="postimage-delete">Xóa</a></li>';
		$('#ul_images').append(li);
		return;
	}
	// id: li_images_0 / post_images_0
	function getNum(id)
	{
		var res = id.split("_");
    	var num = parseInt(res[2]);
    	return num;
	}
	//update number post images
	function updateNum(isDelete=false)
	{
		//total post images
    	var li_num = $("#ul_images").children('li').length;
    	if(isDelete === true) {
    		var postimage_num = parseInt(li_num) - 2;
    	} else {
    		var postimage_num = parseInt(li_num) - 1;
    	}
    	$('#postimage_num').text(postimage_num);
    	return;
	}
</script>
<style>
	.postimage ul {
		padding: 0;
	}
	.postimage ul li {
		list-style: none; margin-bottom: 5px;
	}
	.postimage ul li img {
		width: 100px; height: 100px; display: inline-block; margin-right: 5px;
	}
	a.postimage-btn {
		display: inline-block; cursor: pointer; margin-right: 5px;
	}
	a.postimage-delete {
		display: inline-block; cursor: pointer; color: red; margin-left: 5px;
	}
</style>