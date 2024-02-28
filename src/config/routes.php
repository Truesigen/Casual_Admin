<?php

use Kernel\Resources\Routing\Route;

return [
    'web' => [
        'GET' => [
            Route::create('/', 'GET', [App\Controllers\DefaultController::class, 'index']),
        ],

    ],
    'api' => [

    ],

];
