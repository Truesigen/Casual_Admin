<?php

use Kernel\Resources\Routing\Route;

return [
    'web' => [
        'GET' => [
            Route::get('/', [App\Controllers\DefaultController::class, 'index']),
        ],
        'POST' => [
            Route::post('/register', [App\Controllers\RegisterController::class, 'register']),
        ],
    ],
    'api' => [
        'GET' => [
            Route::get('/tasks', [App\Controllers\Api\TaskController::class, 'index']),
        ],
        'POST' => [
            Route::post('/tasks', [App\Controllers\Api\TaskController::class, 'create']),
        ],
        'PATCH' => [
            Route::patch('/tasks/{id}', [App\Controllers\Api\TaskController::class, 'update']),
        ],
        'DELETE' => [
            Route::delete('/tasks/{id}', [App\Controllers\Api\TaskController::class, 'delete']),
        ],

    ],

];
