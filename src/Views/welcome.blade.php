@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.welcome.templateTitle') }}
@endsection

@section('title')
{{ trans('service::message.welcome.title') }}
@endsection

@section('container')
<p class="text-center">
    {{ trans('service::message.welcome.message') }}
</p>
<p class="text-center">
    <a href="{{ route('service::requirements') }}" class="button">
        {{ trans('service::message.welcome.next') }}
        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
    </a>
</p>
@endsection
