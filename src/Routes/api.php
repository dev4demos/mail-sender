<?php

use Illuminate\Support\Facades\Route;

Route::namespace ('Mail\Sender\Controllers')->as('sender::')->middleware('api')->group(function () {
    // Routes defined here have the api middleware applied
    // like the api.php file in a laravel project
    // They also have an applied controller namespace and a route names.
    Route::resource('mail', 'SenderController')->only([
        'index', 'store'
    ]);
});
