<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'stu/register',
        '/stu/login',
        '/superadmin/login',
        '/superadmin/users-list',
        '/superadmin/update-credits',
        '/admin/login',
        '/admin/users-list',
        '/admin/update-credits',
        '/stu/showResult',
        '/razorpay/payment',
        '/razorpay/payment/callback',
        '/stu/update-credits',
        '/stu/fetchCredit',
        '/stu/fetchTeachers',
        '/stu/fetchTeachers/*',
        '/teacher/*'
    ];
}
