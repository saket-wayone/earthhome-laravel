<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnder extends Model
{
    protected $table='workunder';
    protected $fillable = [
        'manager_id',
        'user_id',
    ];
    use HasFactory;

}
