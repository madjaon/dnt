<header>
	<div class="row show-for-medium">
		<div class="medium-3 columns"><a href="{{ url('/') }}" class="logo"><img src="/img/logo.png" alt="donoithat.org" /></a></div>
		<div class="medium-9 columns"><div class="topmenu">{!! $topmenu !!}</div><div class="clearfix"></div></div>
	</div>
	<div class="mobile-bar show-for-small-only">
		<div class="row">
			<div class="small-3 columns">
				<a class="mobile-open" onclick="mopen();" rel="nofollow"><i class="fa fa-bars" aria-hidden="true"></i></a>
			</div>
			<div class="small-9 columns">
				<a href="{{ url('/') }}" class="logo"><img src="/img/logo.png" alt="donoithat.org" /></a>
			</div>
		</div>
	</div>
</header>
<div class="mobile-box show-for-small-only">
	<div class="mobile-head">
		<strong>Danh mục</strong>
		<a onclick="mclose();" rel="nofollow"><i class="fa fa-times" aria-hidden="true"></i> Đóng Menu</a>
		<div class="clearfix"></div>
	</div>
	<div class="mobile-menu">
		{!! $mobilemenu !!}
		<a class="mobile-close" onclick="mclose();" rel="nofollow"><i class="fa fa-times" aria-hidden="true"></i> Đóng Menu</a>
  	</div>
</div>