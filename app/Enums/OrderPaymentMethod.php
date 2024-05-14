<?php

namespace App\Enums;

enum OrderPaymentMethod: string
{
    case Cash = 'cash';
    case BankTransfer = 'bank-transfer';
    case Qris = 'qris';
    case EWallet = 'e-wallet';
}
