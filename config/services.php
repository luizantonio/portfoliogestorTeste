<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    /*
	*	Original: este
	'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
	*/
	/* Atualizado: este, sobrescrito */
	/*'mailgun' => [
        'domain' =>'sandboxec57cb772ab6484aa417f321f7600e3e.mailgun.org',
        'secret' => 'key-aeb3f5c0d8e92829834ca869ccc243d5',
    ],
    */
    'mail' => [
        'domain' =>'portifoliogestor.com',
        //'secret' =>  env('SES_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
