<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryView extends Model
{
    //
    public $fillable = ['national_id', 'fullname', 'phonenumber', 'recipient_name', 'recipient_phone', 'recipient_nid',  'transfer_value', 'transfer_count', 'recieve_date',  'ben'];

    protected $table = 'beneficiaries_view';
    public static function getDups()
    {

        $pen = PendingBeneficiary::get('national_id'); // getting emps to find their duplicates

        $dups = Beneficiary::whereIn('national_id', $pen)->get('national_id')->union($pen); // getting the employees with same nid
        $dups2 = Beneficiary::whereIn('national_id', $pen);
        $d = BeneficiaryView::whereIn('national_id', $dups)->orderBy('national_id');

        return $d;

    }

    public function getProject(){
        if($this->ben=='ben')
        $p = Beneficiary::where($this->id)->pluck('project_id');

    }
    public function getProjectName(){
        if($this->ben=='ben')
        $p = Project::where($this->id)->pluck('name');

    }
    public  function checkRecord() {

        if(BeneficiaryView::where('national_id', $this->national_id)->count()>1)
        return true;
    return false;
    }
}
