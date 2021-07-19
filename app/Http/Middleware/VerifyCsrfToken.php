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
        'https://chatterminal.herokuapp.com/email',
//        'https://chatterminal.herokuapp.com/slack/*',
//        'https://chatterminal.herokuapp.com/*',
    ];
}
