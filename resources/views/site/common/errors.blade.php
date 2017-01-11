@if(count($errors) > 0)
    <div class="alert callout">
        <h5>Có lỗi xảy ra!</h5>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success'))
    <div class="success callout">
        <b><i class="fa fa-check"></i> Thành công!</b> {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('warning'))
    <div class="warning callout">
        <b><i class="fa fa-warning"></i> Chú ý!</b> {{ Session::get('warning') }}
    </div>
@endif