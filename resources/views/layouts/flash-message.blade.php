@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block alert-fixed">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block alert-fixed">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block alert-fixed">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block alert-fixed">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-fixed">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul class="alert alert-danger" style="list-style-type: none">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-success alert-block alert-fixed" id="success_show" style="display: none">
    <strong id="success_mes"></strong>
</div>

<div class="alert alert-danger alert-block alert-fixed" id="error_show" style="display: none">
    <strong id="error_mes"></strong>
</div>
