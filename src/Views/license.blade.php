@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.license.templateTitle') }}
@endsection

@section('title')
<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
{!! trans('service::message.license.title') !!}
@endsection

@section('container')

<form method="post" action="{{ route('service::license') }}" class="tabs-wrap">
    @csrf
    <div>
        <div class="form-group {{ $errors->has('envato_email') ? ' has-error ' : '' }}">
            <label for="envato_email">
                {{ trans('service::message.license.envato_email') }}
            </label>
            <input type="text" name="envato_email" id="envato_email" value=""
                placeholder="{{ trans('service::message.license.envato_email') }}" />
            @if ($errors->has('envato_email'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('envato_email') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('purchase_code') ? ' has-error ' : '' }}">
            <label for="purchase_code">
                {{ trans('service::message.license.purchase_code') }}
            </label>
            <input type="text" name="purchase_code" id="purchase_code" value=""
                placeholder="{{ trans('service::message.license.purchase_code') }}" />
            @if ($errors->has('purchase_code'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('purchase_code') }}
            </span>
            @endif
        </div>



        <div class="form-group {{ $errors->has('installation_path') ? ' has-error ' : '' }}">
            <label for="installation_path">
                {{ trans('service::message.license.installation_path') }}
            </label>
            <input type="text" name="installation_path" id="installation_path" value="{{url('/')}}" readonly
                placeholder="{{ trans('service::message.license.installation_path') }}" />
            @if ($errors->has('installation_path'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('installation_path') }}
            </span>
            @endif
        </div>

        <div class="buttons">
            <button class="button">
                {{ trans('service::message.license.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </div>

</form>

@endsection

@section('scripts')

@endsection
