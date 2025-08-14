<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolHistory extends Model
{
    protected $table='poolhistory';
    protected $fillable = [
        'id',
        'user_id',
        'lead_id'
    ];
    use HasFactory;
}
