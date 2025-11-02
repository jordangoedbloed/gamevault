<?php
// app/Http/Kernel.php
protected $middlewareAliases = [
    'auth'      => \App\Http\Middleware\Authenticate::class,
    'verified'  => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'role'      => \App\Http\Middleware\RoleMiddleware::class,
];


