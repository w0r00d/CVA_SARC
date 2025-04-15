<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficiary extends Model
{
    //
    protected $fillable = ['national_id', 'h_national_id','fullname','h_fullname', 'phonenumber', 'h_phonenumber','recipient_name','h_recipient_name', 'recipient_phone', 'h_recipient_phone','recipient_nid', 'h_recipient_nid','transfer_value', 'h_transfer_value','transfer_count','h_transfer_count','recieve_date','project_id','created_by','updated_by'];


    public function project() : BelongsTo{

        return $this->belongsTo(Project::class);
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
