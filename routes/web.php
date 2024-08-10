<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::redirect('/admin/login', '/login');

Route::get('/send-test-email', function () {
    $user = \App\Models\User::first();
    Mail::to('testing@email.com')->send(new \App\Mail\WelcomeMail($user));
    return 'Test email sent!';
});
