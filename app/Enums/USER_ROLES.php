<?php

namespace App\Enums;

enum USER_ROLES: int
{
    case SUPER_ADMIN = 0;
    case ADMIN = 1;
    case OWNER = 2;
    case USER = 3;

    public function label(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::OWNER => 'Owner',
            self::USER => 'Customer',
        };
    }

    public static function labels(): array
    {
        $labels = [];

        foreach (self::cases() as $role) {
            $labels[$role->value] = $role->label();
        }

        return $labels;
    }

    public static function adminLabels(): array
    {
        $allowed_roles = [
            self::ADMIN,
            self::USER,
        ];

        $labels = [];

        foreach ($allowed_roles as $role) {
            $labels[$role->value] = $role->label();
        }

        return $labels;
    }
}
