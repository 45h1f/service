@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.final.templateTitle') }}
@endsection

@section('title')
<i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
{{ trans('service::message.final.title') }}
@endsection

@section('container')

<div class="pb-1 text-center">
    {{ trans('service::message.final.finished') }}
</div>


<div class="buttons">
    <a href="{{ url('/') }}" class="button">{{ trans('service::message.final.exit') }}</a>
</div>

@endsection
