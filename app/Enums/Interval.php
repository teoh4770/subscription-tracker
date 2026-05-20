<?php

namespace App\Enums;

enum Interval: string
{
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case YEARLY = 'yearly';

    public function label(): string
    {
        return match ($this) {
            Interval::WEEKLY => 'Weekly',
            Interval::MONTHLY => 'Monthly',
            Interval::QUARTERLY => 'Quarterly',
            Interval::YEARLY => 'Yearly',
        };
    }
}
