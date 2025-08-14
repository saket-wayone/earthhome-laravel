<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedPlan extends Model
{
    protected $table ='purchasedcredits';
    protected $fillable = [
        'company_id',
        'plan_id',
        'unique_code',
        'alloted_user_id',
        'alloted_date',
        'expiry_date',
        'created_at',
    ];


    use HasFactory;

   
}
