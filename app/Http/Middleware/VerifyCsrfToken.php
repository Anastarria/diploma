<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:9000/register',
        'http://localhost:9000/editavatar',
        'http://localhost:9000/invite',
        'http://localhost:9000/deleteavatar',
        'http://localhost:9000/profile/edit',
        'http://localhost:9000/books/*',
        'http://localhost:9000/login'

    ];
}
