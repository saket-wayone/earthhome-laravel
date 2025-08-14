<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotManager extends Model
{
     protected $table ='allotmanagers';
     protected $fillable  = ['id','manager_id','mr_id'];
    use HasFactory;
}
