<?php
namespace App\Enums;

enum Sectors: String {
    //
    case Health              = 'Health';
    case Livelihood          = 'Livelihood';
    case Protection          = 'Protection';
    case Disaster_Management = 'Disaster Management';
    case Wash                = 'Wash';
    case Risk_Education      = 'Risk Educationt';
    case MPCA                = 'MPCA';

    public static function all()
    {

        return array_column(self::cases(), 'value', 'value');
    }

}
