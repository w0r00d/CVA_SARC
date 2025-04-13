<?php
namespace App\Enums;

enum Governates: String {
    //
    case Damascus       = 'Damascus';
    case Aleppo         = 'Aleppo';
    case Homs           = 'Homs';
    case Hama           = 'Hama';
    case Latakia        = 'Latakia';
    case Tartous        = 'Tartous';
    case As_Sweida      = 'As-Sweida';
    case Ar_Raqqa       = 'Ar-Raqqa';
    case Daraa          = 'Daraa';
    case Idleb          = 'Idleb';
    case Quneitra       = 'Quneitra';
    case Rural_Damascus = 'Rural Damascus';
    case Der_ezzor      = 'Der-ezzor';
    case Alhasaka       = 'Alhasaka';

    // Method to get all governates
    public static function all()
    {

        return array_column(self::cases(), 'value', 'value');
    }
}
