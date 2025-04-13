<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    //
    protected $fillable = ['name','donor','partner','start_date','end_date','status','governate','sector','modality'];


    public function Beneficiaries(): HasMany{

        return $this->hasMany(Beneficiary::class);

    }

    public function getNames(){
        return Project::get('name');
    }
}
