<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

if (!function_exists('isActive')) {
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (!function_exists('servicePublicPath')) {

    function servicePublicPath($path)
    {
        return asset('public/' . $path);
    }
}

if (!function_exists('checkRequirements')) {

    function checkRequirements(array $requirements)
    {
        $results = [];
        foreach ($requirements as $type => $requirement) {
            switch ($type) {
                case 'php':
                    foreach ($requirements[$type] as $requirement) {
                        $results['requirements'][$type][$requirement] = true;

                        if (!extension_loaded($requirement)) {
                            $results['requirements'][$type][$requirement] = false;

                            $results['errors'] = true;
                        }
                    }
                    break;
                    // check apache requirements
                case 'apache':
                    foreach ($requirements[$type] as $requirement) {
                        // if function doesn't exist we can't check apache modules
                        if (function_exists('apache_get_modules')) {
                            $results['requirements'][$type][$requirement] = true;

                            if (!in_array($requirement, apache_get_modules())) {
                                $results['requirements'][$type][$requirement] = false;

                                $results['errors'] = true;
                            }
                        }
                    }
                    break;
            }
        }

        return $results;
    }
}

if (!function_exists('checkPHPversion')) {
    function checkPHPversion(string $minPhpVersion = null)
    {
        $minVersionPhp = $minPhpVersion;
        $currentPhpVersion = getPhpVersionInfo();
        $supported = false;

        if ($minPhpVersion == null) {
            $minVersionPhp = getMinPhpVersion();
        }

        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }

        $phpStatus = [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported,
        ];

        return $phpStatus;
    }
}

if (!function_exists('getPhpVersionInfo')) {
    function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }
}

if (!function_exists('getMinPhpVersion')) {
    function getMinPhpVersion()
    {
        return config('service.core.minPhpVersion');
    }
}


if (!function_exists('checkPermissions')) {
    function checkPermissions(array $folders)
    {
        $results['errors'] = null;
        $results['permissions'] = [];
        foreach ($folders as $folder => $permission) {

            if (!(getPermission($folder) >= $permission)) {
                $results['errors'] = true;
                $isSet = false;
            } else {
                $isSet = true;
            }
            $results['permissions'][] = [
                'folder' => $folder,
                'permission' => $permission,
                'isSet' => $isSet,
            ];
        }

        return $results;
    }
}

if (!function_exists('getPermission')) {
    function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }
}

if (!function_exists('envPath')) {
    function envPath()
    {
        return base_path('.env');
    }
}

if (!function_exists('envExamplePath')) {
    function envExamplePath()
    {
        return base_path('.env.example');
    }
}

if (!function_exists('getEnvContent')) {
    function getEnvContent()
    {
        if (!file_exists(envPath())) {
            if (file_exists(envExamplePath())) {
                copy(envExamplePath(), envPath());
            } else {
                touch(envPath());
            }
        }

        return file_get_contents(envPath());
    }
}


if (!function_exists('checkDatabaseConnection')) {
    function checkDatabaseConnection($request)
    {
        $settings = config("database.connections.mysql");
        config([
            'database' => [
                'default' => 'mysql',
                'connections' => [
                    'mysql' => array_merge($settings, [
                        'driver' => 'mysql',
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password')
                    ]),
                ],
            ],
        ]);

        DB::purge();

        try {
            DB::connection()->getPdo();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('saveDatabaseInfoInEnv')) {
    function saveDatabaseInfoInEnv($request)
    {
        $results = trans('installer_messages.environment.success');
        WriteInEnv('DB_HOST', $request->database_hostname);
        WriteInEnv('DB_PORT', $request->database_port);
        WriteInEnv('DB_DATABASE', $request->database_name);
        WriteInEnv('DB_USERNAME', $request->database_username);
        WriteInEnv('DB_PASSWORD', $request->database_password);
        WriteInEnv('APP_DEBUG', 'false');

        return $results;
    }
}

if (!function_exists('WriteInEnv')) {
    function WriteInEnv($envKey, $envValue)
    {
        $envValue = str_replace('\\', '\\' . '\\', $envValue);
        $value = '"' . $envValue . '"';
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n";
        $keyPosition = strpos($str, "{$envKey}=");


        if (is_bool($keyPosition)) {

            $str .= $envKey . '="' . $envValue . '"';
        } else {
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "{$envKey}={$value}", $str);

            $str = substr($str, 0, -1);
        }

        if (!file_put_contents($envFile, $str)) {
            return false;
        } else {
            return true;
        }
    }
}
