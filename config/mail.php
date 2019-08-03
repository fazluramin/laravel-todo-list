<?php

return [
    'driver' => env('MAIL_DRIVER'), 
    'from' => array('address' => 'us@quarkspark.com', 'name' => 'Quark Spark'),
    'pretend'    => false,
];

// return [
//     'driver' => env('MAIL_DRIVER', 'smtp'),
//     'host' => env('MAIL_HOST', 'smtp.gmail.com'),
//     'port' => env('MAIL_PORT', 587),
//     'from' => ['MAIL_FROM_ADDRESS' => 'fazlur.amin@gmail.com', 'MAIL_FROM_NAME' => 'FazlurTestCase'],
//     'encryption' => env('MAIL_ENCRYPTION', 'tls'),
//     'username' => env('fazlur.amin@gmail.com'),
//     'password' => env('faezloere31'),
//     'sendmail' => '/usr/sbin/sendmail -t',
//     'pretend' => false,

// ];

// return [
//     "driver" => "smtp",
//     "host" => "smtp.googlemail.com",
//     "port" => 465,
//     "from" => array(
//         "address" => "admin@laravel.com",
//         "name" => "Admin Laravel Quark Spark"
//     ),
//     "username" => "fazlur.amin@gmail.com",
//     "password" => "faezloere31",
//     "sendmail" => "/usr/sbin/sendmail -bs"
// ];

// return [
//     "driver" => "smtp",
//     "host" => "smtp.mailtrap.io",
//     "port" => 2525,
//     "from" => array(
//         "address" => "admin@laravel.com",
//         "name" => "Admin Laravel Quark Spark"
//     ),
//     "username" => "28668abd94c070",
//     "password" => "8f3c8fc5e8ad6c",
//     "sendmail" => "/usr/sbin/sendmail -bs"
// ];
