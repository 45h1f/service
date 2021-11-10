<?php

return [

    'title' => 'CodeGame',
    'next' => 'Next Step',
    'back' => 'Previous',
    'finish' => 'Install',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],

    'welcome' => [
        'templateTitle' => 'Welcome',
        'title'   => 'Welcome to CodeGame',
        'message' => 'Thank you for choosing CodeGame. Please Follow few step for complete installation',
        'next'    => 'Lets Start',
    ],

    'requirements' => [
        'templateTitle' => 'Step 1 | Server Requirements',
        'title' => 'Server Requirements',
        'next'    => 'Check Permission',
    ],

    'permissions' => [
        'templateTitle' => 'Step 2 | Permissions',
        'title' => 'Permissions',
        'next' => 'License Verify',
    ],

    'license' => [
        'templateTitle' => 'Step 3 | License verify',
        'title' => 'License Verification',
        'envato_email' => 'Envato Email Address',
        'purchase_code' => 'Purchase Code',
        'installation_path' => 'Installation Path',
        'next' => 'Verify',
    ],


    'database' => [
        'templateTitle' => 'Step 4 | Database Setup',
        'title' => 'Database Setup',
        'next' => 'Check Database',
        'form' => [
            'db_connection_failed' => 'Could not connect to the database.',
            'db_connection_label' => 'Database Connection',
            'db_connection_label_mysql' => 'mysql',
            'db_connection_label_sqlite' => 'sqlite',
            'db_connection_label_pgsql' => 'pgsql',
            'db_connection_label_sqlsrv' => 'sqlsrv',
            'db_host_label' => 'Database Host',
            'db_host_placeholder' => 'Database Host',
            'db_port_label' => 'Database Port',
            'db_port_placeholder' => 'Database Port',
            'db_name_label' => 'Database Name',
            'db_name_placeholder' => 'Database Name',
            'db_username_label' => 'Database User Name',
            'db_username_placeholder' => 'Database User Name',
            'db_password_label' => 'Database Password',
            'db_password_placeholder' => 'Database Password',

        ]
    ],

    'user' => [
        'templateTitle' => 'Step 5 | Admin Setup',
        'title' => 'Admin Setup',
        'next' => 'Create Admin',
        'form' => [
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
        ]
    ],



    'final' => [
        'title' => 'Installation Finished',
        'templateTitle' => 'Installation Finished',
        'finished' => 'Application has been successfully installed.',
        'exit' => 'Go to Home',
    ],


    'install' => 'Install',


    'installed' => [
        'success_log_message' => 'Application successfully INSTALLED on ',
    ],





];
