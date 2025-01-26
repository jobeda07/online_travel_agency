<?php

namespace App\Enums;

enum RoomTypeEnum: string
{
    case SINGLE = 'single_room';
    case MULTIPLE = 'multiple_room';

    public function display()
    {
        return match ($this) {
            self::SINGLE => 'Single Room',
            self::MULTIPLE => 'Multiple Room',
        };
    }
}
