<?php

namespace App\Enums;

enum SeatStatusEnum: string
{
    case AVAILABLE = 'available';
    case RESERVED = 'reserved';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::RESERVED => 'Reserved',
        };
    }
}
