<?php

namespace Ashiful\Service\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Validator;

class ServiceController extends Controller
{

    public function index()
    {
        return view('service::welcome');
    }

    public function environment()
    {
        return view('service::environment');
    }

    public function requirements()
    {

        $phpSupportInfo = checkPHPversion(
            config('service.core.minPhpVersion')
        );
        $requirements = checkRequirements(
            config('service.requirements')
        );

        return view('service::requirements', compact('requirements', 'phpSupportInfo'));
    }

    public function permissions()
    {
        $permissions = checkPermissions(
            config('service.permissions')
        );


        return view('service::permissions', compact('permissions'));
    }

    public function license()
    {
        return view('service::license');
    }

    public function licenseSave()
    {
        return redirect()->route('service::database');
    }

    public function database()
    {
        $envConfig = getEnvContent();
        return view('service::database', compact('envConfig'));
    }

    public function databaseSave(Request $request)
    {
        $rules = config('service.environment.form.rules');

        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('service::database')->withInput()->withErrors($validator->errors());
        }

        if (!checkDatabaseConnection($request)) {
            return redirect()->route('service::database')->withInput()->withErrors([
                'database_connection' => trans('installer_messages.environment.wizard.form.db_connection_failed'),
            ]);
        }
        $results = saveDatabaseInfoInEnv($request);
        return redirect()->route('service::user')
            ->with(['results' => $results]);
    }

    public function user()
    {
        return view('service::user');
    }

    public function userSave(Request $request)
    {

        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('service::user')->withInput()->withErrors($validator->errors());
        }

        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('key:generate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);




        $user = User::find(1);
        if (!$user) {
            $user = new User();
        }
        $user->name = 'Super admin';
        $user->email = $request->email;
        $user->email_verified_at = now();
        if (Schema::hasColumn('users', 'role_id')) {
            $user->role_id = 1;
        }

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('service::final');
    }


    public function final()
    {
        $installedLogFile = storage_path('.app_installed');

        $dateStamp = date('Y/m/d h:i:sa');

        if (!file_exists($installedLogFile)) {
            $message = trans('installer_messages.installed.success_log_message') . $dateStamp . "\n";

            file_put_contents($installedLogFile, $message);
        } else {
            $message = trans('installer_messages.updater.log.success_message') . $dateStamp;

            file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return view('service::finished');
    }
}
