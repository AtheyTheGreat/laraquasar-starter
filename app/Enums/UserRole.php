<?php

namespace App\Enums;

use ReflectionEnum;

enum UserRole: string
{

    case SUPER_USER = 'SUPER_USER';

    public static function fromName(String $name): static
    {
        return (new ReflectionEnum(
            static::class
        )
        )
            ->getCase($name)
            ->getValue();
    }
}
