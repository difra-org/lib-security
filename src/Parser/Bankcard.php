<?php

declare(strict_types=1);

namespace Difra\Security\Parser;

/**
 * Class Bankcard
 * Tools for bank cards
 * @package Drafton\Libs
 */
class Bankcard
{
    const TYPE_AMEX = 'amex';
    const TYPE_MAESTRO = 'maestro';
    const TYPE_MASTERCARD = 'mastercard';
    const TYPE_VISA = 'visa';
    const TYPE_UNIONPAY = 'unionpay';
    // todo: other card types https://en.wikipedia.org/wiki/Payment_card_number#Issuer_identification_number_.28IIN.29
//    const TYPE_DINERS_CARTE_BLANCHE = 'diners carte blanche';
//    const TYPE_DINERS_INTERNATIONAL = 'diners international';
//    const TYPE_DINERS_AMERICA = 'diners us and canada';
//    const TYPE_DISCOVER = 'discover';
//    const TYPE_INTERPAYMENT = 'interpayment';
//    const TYPE_INSTAPAYMENT = 'instapayment';
//    const TYPE_JCB = 'jcb';
//    const TYPE_NSPK_MIR = 'npsk mir';
//    const TYPE_UATP = 'uatp';
//    const TYPE_VERVE = 'verve';
//    const TYPE_CARDGUARD = 'cardguard';

    /**
     * Get card type
     * @param $string
     * @return null|string
     */
    public static function getType($string): ?string
    {
        // todo: cache in static array
        $num = str_replace([' ', '-'], '', $string);
        if (!ctype_digit($num)) {
            return null;
        }
        $len = strlen($num);

        // check number (luhn)
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $digit = $num[$i];
            if ($i % 2 == ($len % 2)) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        if ($sum % 10 != 0) {
            return null;
        }

        $prefix1 = (int)substr($num, 0, 1);
        $prefix2 = (int)substr($num, 0, 2);
        if ($len == 15 and in_array($prefix2, [34, 37])) {
            return self::TYPE_AMEX;
        } elseif ($len >= 16 and $len <= 19 and $prefix2 == 62) {
            return self::TYPE_UNIONPAY;
        } elseif ($len >= 12 and $len <= 19 and ($prefix2 == 50 or ($prefix2 >= 56 and $prefix2 <= 69))) {
            return self::TYPE_MAESTRO;
        } elseif ($len == 16 and $prefix2 >= 51 and $prefix2 <= 55) {
            return self::TYPE_MASTERCARD;
        } elseif (in_array($len, [13, 16, 19]) and $prefix1 == 4) {
            return self::TYPE_VISA;
        }
        return null;
    }
}
