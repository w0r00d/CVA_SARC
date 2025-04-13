<?php

namespace App\Enum;

enum Roles: String
{
    //
    case Super_Admin       = 'Super Admin';
    case HQ_Admin             = 'HQ Admin';
    case Branch_admin      = 'Branch Admin';

     // Method to get all Roles
     public static function all()
     {
          return array_column(self::cases(), 'value', 'value');
     }
}
