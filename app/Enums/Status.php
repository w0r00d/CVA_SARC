<?php

namespace App\Enums;

enum Status : String
{
    //

    case On_Going = 'On Going';
    case Stopped ='Stopped';
    case Pending = 'Pending';
    case Done = 'Done';
    case Planning = 'Planning';


    public static function all()
    {

        return array_column(self::cases(), 'value', 'value');
    }
}
