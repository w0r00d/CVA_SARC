<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingBeneficiary extends Model
{
    protected $fillable = ['national_id' ,'fullname','phonenumber', 'recipient_name', 'recipient_phone' ,'recipient_nid' ,'transfer_value','transfer_count',];
}
