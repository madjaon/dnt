@include('site.common.head')
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="row column">
  <div class="container">

  @include('site.common.top')

  <?php $device = getDevice2(); ?>
  @if(isset($isHome) && $isHome == true && $device != MOBILE && isset($homesliders) && count($homesliders) > 0)
  <div>@include('site.common.homeslider', ['homesliders' => $homesliders])</div>
  @endif

  <div class="main">

    @include('site.common.ad', ['posPc' => 1, 'posMobile' => 2])

    <div class="row">

      <div class="medium-9 medium-push-3 columns">
        @if(isset($isHome) && $isHome == true)
        <div class="homeline"><i class="fa fa-phone" aria-hidden="true"></i> Tư vấn tốt nhất: {!! CommonMethod::genHotline($confighotline) !!}</div>
        @endif
        <div class="content">
          @yield('content')
        </div>
      </div>
      <div class="medium-3 medium-pull-9 columns">
          @include('site.common.side')
      </div>
      
    </div>

    @include('site.common.ad', ['posPc' => 3, 'posMobile' => 4])

  </div>

  <div class="loved"></div>

  @include('site.common.bottom')

  </div>
</div>

<a class="gotop" href="#" title="Lên đầu trang" rel="nofollow"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>

<script src="{{ asset('js/app.js') }}"></script>
@if(isset($isProduct) && $isProduct == true)
@include('site.post.detailscript')
@endif
</body>
</html>
