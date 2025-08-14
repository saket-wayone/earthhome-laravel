<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PrimaryPlan extends Model
{
    protected $table ='primaryplans';
    protected $fillable = [
        'company_id',
        'type',
        'totalamount',
        'expiry_date',
        'quantity',
    ];

    public function Companies(){
        return $this->belongsTo(User::class,'company_id');
    }


    use HasFactory;
}
