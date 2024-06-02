@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Settings</h3>
                </div>
                @can('role-list')
                    <div class="col-md-6">
                        <a class="btn btn-primary  float-right" href="{{ route('roles.index') }}"> Back</a>
                    </div>
                @endcan
            </div>
        </div>

        <div class="card-body">
            {!! Form::model($setting, [
                'route' => ['settings.update', $setting->id],
                'method' => 'patch',
                'files' => 'true',
            ]) !!}
            <div class="row">
                <div class="form-group col-sm-6">
                    {!! Form::label('app_name', 'App Name:') !!}
                    {!! Form::text('app_name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('app_title', 'App Title:') !!}
                    {!! Form::text('app_title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('address', 'Address:') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('phone', 'Phone:') !!}
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('app_email', 'App Email:') !!}
                    {!! Form::text('app_email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('ad', 'Ad login?') !!}
                    @if ($setting->is_ad_login)
                        <div>
                            {{ Form::checkbox('is_ad_login') }}
                        </div>
                    @else
                        <div>
                            <button type="button" onclick="ad_active_check()" class="btn btn-primary">
                                Check LDAP
                            </button>
                        </div>
                        {{ Form::hidden('is_ad_login', $setting->is_ad_login, ['id' => 'is_ad_login']) }}
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('app_logo', 'App Logo:') !!}
                    {!! Form::file('app_logo') !!}
                    {{-- <div class="loader">Loading...</div> --}}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('app_fav', 'App Fav:') !!}
                    {!! Form::file('app_fav') !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('myjsfile')
    <script type="text/javascript">
        function ad_active_check() {
            $.ajax({
                type: 'POST',
                url: '{{ URL('/ad_active_check') }}',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status) {
                        console.log(data.status)
                        $('#is_ad_login').val(1);
                        $('#success_show').show();
                        $('#success_mes').html(data.message);


                    } else {
                        $('#error_show').show();
                        $('#error_mes').html(data.message);
                    }
                }
            });
        }
    </script>
@stop
