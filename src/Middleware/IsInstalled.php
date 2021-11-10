<?php

namespace Ashiful\Service\Middleware;

use Closure;
use Redirect;

class IsInstalled
{
    protected $except = [
        'install', 'install/*'
    ];
    public function handle($request, Closure $next)
    {

        if ($this->inExceptArray($request)) {
            return $next($request);
        }

        if (!$this->alreadyInstalled()) {
            return redirect('/install');
        } else {
        }

        return $next($request);
    }


    public function alreadyInstalled()
    {
        return file_exists(storage_path('.app_installed'));
    }




    protected function inExceptArray($request)
    {

        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}

// .access_code
// . access_log
// . account_email
// . app_installed
//     . version
//     . install_count
