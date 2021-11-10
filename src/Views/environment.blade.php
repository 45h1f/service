@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.environment.menu.templateTitle') }}
@endsection

@section('title')
<i class="fa fa-cog fa-fw" aria-hidden="true"></i>
{!! trans('service::message.environment.menu.title') !!}
@endsection

@section('container')

<p class="text-center">
    {!! trans('service::message.environment.menu.desc') !!}
</p>
<div class="buttons">
    <a href="{{ route('service::environmentWizard') }}" class="button button-wizard">
        <i class="fa fa-sliders fa-fw" aria-hidden="true"></i> {{
        trans('service::message.environment.menu.wizard-button') }}
    </a>
    <a href="{{ route('service::environmentClassic') }}" class="button button-classic">
        <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{
        trans('service::message.environment.menu.classic-button') }}
    </a>
</div>

@endsection
