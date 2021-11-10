<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{
        trans('service::message.title') }}</title>
    <link rel="icon" type="image/png" href="{{ servicePublicPath('service/img/favicon/favicon-16x16.png') }}"
        sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ servicePublicPath('service/img/favicon/favicon-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ servicePublicPath('service/img/favicon/favicon-96x96.png') }}"
        sizes="96x96" />
    <link href="{{ servicePublicPath('service/css/style.css') }}" rel="stylesheet" />
    @yield('style')
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
    </script>
</head>

<body>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">@yield('title')</h1>
            </div>
            <ul class="step">
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::final') }}">
                    <i class="step__icon fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::user')}}">
                    @if(Request::is('install/environment') || Request::is('install/environment/wizard') ||
                    Request::is('install/environment/classic') )
                    <a href="{{ route('service::environment') }}">
                        <i class="step__icon fa fa-user" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-user" aria-hidden="true"></i>
                    @endif
                </li>





                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::database') }}">
                    @if(Request::is('install') || Request::is('install/requirements') ||
                    Request::is('install/environment') ||
                    Request::is('install/database')
                    )
                    <a href="{{ route('service::database') }}">
                        <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    @endif
                </li>

                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::license') }}">
                    @if(Request::is('install') || Request::is('install/requirements')
                    || Request::is('install/environment')||
                    Request::is('install/license'))
                    <a href="{{ route('service::license') }}">
                        <i class="step__icon fa fa-credit-card-alt" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-credit-card-alt" aria-hidden="true"></i>
                    @endif
                </li>




                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::permissions') }}">
                    @if(Request::is('install/permissions') || Request::is('install/environment'))
                    <a href="{{ route('service::permissions') }}">
                        <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    @endif
                </li>




























                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::requirements') }}">
                    @if(Request::is('install') || Request::is('install/requirements') ||
                    Request::is('install/permissions') || Request::is('install/environment'))
                    <a href="{{ route('service::requirements') }}">
                        <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('service::welcome') }}">
                    @if(Request::is('install') || Request::is('install/requirements') ||
                    Request::is('install/permissions') || Request::is('install/environment'))
                    <a href="{{ route('service::welcome') }}">
                        <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
            </ul>
            <div class="main">
                @if (session('message'))
                <p class="text-center alert">
                    <strong>
                        @if(is_array(session('message')))
                        {{ session('message')['message'] }}
                        @else
                        {{ session('message') }}
                        @endif
                    </strong>
                </p>
                @endif
                <!--
                @if(session()->has('errors'))
                <div class="alert alert-danger" id="error_alert">
                    <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4>
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ trans('service::message.forms.errorTitle') }}
                    </h4>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                -->
                @yield('container')
            </div>
        </div>
    </div>
    @yield('scripts')
    <script type="text/javascript">
        var x = document.getElementById('error_alert');
        if(x){
            var y = document.getElementById('close_alert');
            if(y){
                y.onclick = function() {
                x.style.display = "none";
                };
            }

        }

    </script>
</body>

</html>
