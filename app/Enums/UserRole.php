<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::STAFF => 'Staff Member',
            self::USER => 'Regular User',
        };
    }
}