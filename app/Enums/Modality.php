<?php
namespace App\Enums;

enum Modality: String {
    //
    case Cash              = 'Cash';
    case Voucher          = 'Voucher';
    case eVoucher          = 'eVoucher';
   

    public static function all()
    {

        return array_column(self::cases(), 'value', 'value');
    }

}
