<?php

namespace App\Enums;

enum UserStatus: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case EDITOR = 'Editor';
}