@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="card-title pull-left">Settings</h3>
                    <a href="{{ route('settings.modify') }}" class="btn btn-info pull-right">Edit</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('app_name', 'App Name:') !!}
                        <p>{{ $setting->app_name }}</p>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('app_title', 'App Title:') !!}
                        <p>{{ $setting->app_title }}</p>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('address', 'Address:') !!}
                        <p>{{ $setting->address }}</p>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('phone', 'Phone:') !!}
                        <p>{{ $setting->phone }}</p>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('app_email', 'App Email:') !!}
                        <p>{{ $setting->app_email }}</p>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('app_logo', 'App Logo:') !!}
                        <img src="{{ asset('uploads/' . $setting->app_logo) }}" height="40">
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('app_fav', 'App Fav:') !!}
                        <img src="{{ asset('uploads/' . $setting->app_fav) }}" height="40">
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('updated_at', 'Active Directory :') !!}
                        <p>{!! $setting->is_ad_login?"Your Active Directory is <strong>Connected</strong>":"Your Active Directory is <strong>Disconnected</strong>" !!}</p>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('updated_at', 'Last Updated:') !!}
                        <p>{{ $setting->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
