<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidAmountModel extends Model
{
    protected  $table  = 'paymen_received';
    use HasFactory;


    public function leads()
    {
        return $this->hasMany(leadModel::class, 'id');
    }
}
