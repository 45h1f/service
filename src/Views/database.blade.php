@extends('service::layouts.master')

@section('template_title')
{{ trans('service::message.database.templateTitle') }}
@endsection

@section('title')
<i class="fa fa-magic fa-fw" aria-hidden="true"></i>
{!! trans('service::message.database.title') !!}
@endsection

@section('container')

<form method="post" action="{{ route('service::database') }}" class="tabs-wrap">
    @csrf
    <div>

        <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
            <label for="database_hostname">
                {{ trans('service::message.database.form.db_host_label') }}
            </label>
            <input type="text" name="database_hostname" id="database_hostname"
                value="{{config('database.connections.mysql.host')}}"
                placeholder="{{ trans('service::message.database.form.db_host_placeholder') }}" />
            @if ($errors->has('database_hostname'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_hostname') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
            <label for="database_port">
                {{ trans('service::message.database.form.db_port_label') }}
            </label>
            <input type="number" name="database_port" id="database_port"
                value="{{config('database.connections.mysql.port')}}"
                placeholder="{{ trans('service::message.database.form.db_port_placeholder') }}" />
            @if ($errors->has('database_port'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_port') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
            <label for="database_name">
                {{ trans('service::message.database.form.db_name_label') }}
            </label>
            <input type="text" name="database_name" id="database_name"
                value="{{config('database.connections.mysql.database')}}"
                placeholder="{{ trans('service::message.database.form.db_name_placeholder') }}" />
            @if ($errors->has('database_name'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_name') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
            <label for="database_username">
                {{ trans('service::message.database.form.db_username_label') }}
            </label>
            <input type="text" name="database_username" id="database_username"
                value="{{config('database.connections.mysql.username')}}"
                placeholder="{{ trans('service::message.database.form.db_username_placeholder') }}" />
            @if ($errors->has('database_username'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_username') }}
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
            <label for="database_password">
                {{ trans('service::message.database.form.db_password_label') }}
            </label>
            <input type="password" name="database_password" id="database_password"
                value="{{config('database.connections.mysql.password')}}"
                placeholder="{{ trans('service::message.database.form.db_password_placeholder') }}" />
            @if ($errors->has('database_password'))
            <span class="error-block">
                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_password') }}
            </span>
            @endif
        </div>

        <div class="buttons">
            <button class="button">
                {{ trans('service::message.database.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </div>

</form>

@endsection

@section('scripts')

@endsection
