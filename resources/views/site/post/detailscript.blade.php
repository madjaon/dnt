<link rel="stylesheet" href="{{ asset('css/etalage.css') }}">
<script src="{{ asset('js/etalage.js') }}"></script>
<script src="{{ asset('js/zoom/jquery.zoom.min.js') }}"></script>
<script type="text/javascript">
//    var zoom_enabled = false;
//    var zoom_type = 0;
	jQuery(document).ready(function(){
		var src_img_width = 900;
		var src_img_height = 900;
		var width, height, thumb_position, small_thumb_count;
		small_thumb_count = 4;
		width = jQuery(".detail-image").width()-15;
		height = width;
		thumb_position = "bottom";
		$('#etalage').etalage({
			thumb_image_width: width,
			thumb_image_height: height,
			source_image_width: src_img_width,
			source_image_height: src_img_height,
			zoom_area_width: width,
			zoom_area_height: height,
			zoom_enable: false,
			small_thumbs:small_thumb_count,
			smallthumb_hide_single: false,
			smallthumbs_position: thumb_position,
			small_thumbs_width_offset: 0,
			show_hint: false,
			show_icon: false,
			autoplay: false
		});
		if(jQuery(window).width()<768){
			jQuery(".etalage li.etalage_thumb").zoom();
		}
	});
</script>