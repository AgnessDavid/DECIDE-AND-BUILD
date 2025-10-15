<?php

namespace App\Enums;

enum MoyenPaiement: string
{
    // Espèces
    case ESPECES = 'especes';

    // Mobile Money
    case WAVE = 'wave';
    case MOOV_MONEY = 'moov_money';
    case MTN_MONEY = 'mtn_money';
    case ORANGE_MONEY = 'orange_money';

    // En ligne / Carte bancaire
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case CARTE = 'carte';

    // Crypto
    case BITCOIN = 'bitcoin';
    case ETHEREUM = 'ethereum';
}
