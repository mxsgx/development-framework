<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Unpaid = 'unpaid';
    case Settled = 'settled';
    case Active = 'active';
    case Refunding = 'refunding';
    case Canceled = 'canceled';
    case Completed = 'completed';
}
