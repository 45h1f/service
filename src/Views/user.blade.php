@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.user.templateTitle') }}
@endsection

@section('title')
<i class="fa fa-magic fa-fw" aria-hidden="true"></i>
{!! trans('service::message.user.title') !!}
@endsection

@section('container')

<form method="post" action="{{ route('service::user') }}" class="tabs-wrap">
    @csrf
    <div>



        <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
            <label for="email">
                {{ trans('service::message.user.form.email') }}
            </label>
            <input type="text" name="email" id="email" value="" placeholder="" />
            @if ($errors->has('email'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('email') }}
            </span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
            <label for="password">
                {{ trans('service::message.user.form.password') }}
            </label>
            <input type="password" name="password" id="password" value=""
                placeholder="{{ trans('service::message.user.form.password') }}" />
            @if ($errors->has('password'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
            <label for="confirm_password">
                {{ trans('service::message.user.form.password_confirmation') }}
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" value=""
                placeholder="{{ trans('service::message.user.form.password_confirmation') }}" />
            @if ($errors->has('password_confirmation'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('password_confirmation') }}
            </span>
            @endif
        </div>

        <div class="buttons">
            <button class="button">
                {{ trans('service::message.user.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </div>

</form>

@endsection

@section('scripts')

@endsection
