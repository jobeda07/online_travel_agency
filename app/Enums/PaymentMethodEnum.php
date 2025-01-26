<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case CASH = 'cash';
    case BKASH = 'bkash';
    case ROCKET = 'rocket';
    case STRIPE = 'stripe';
    case AMARPAY = 'amarpay';
    case SSL_COMMERCE = 'ssl_commerce';

    public function display()
    {
        return match ($this) {
            self::CASH => 'Cash',
            self::BKASH => 'Bkash',
            self::ROCKET => 'Rocket',
            self::STRIPE => 'Stripe',
            self::AMARPAY => 'Amarpay',
            self::SSL_COMMERCE => 'SSL Commerce',
        };
    }
}
