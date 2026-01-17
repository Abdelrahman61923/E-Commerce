<?php

namespace App\Enums;

enum UserType: string
{
    use Renderable;

    case USER = 'user';
    case ADMIN = 'admin';
    case SUPERADMIN = 'super-admin';
}
