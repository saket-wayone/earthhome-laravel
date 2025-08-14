<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plantype';
    use HasFactory;


    public static function editfunction($data)
    {
        return Plan::where('id', $data)->first();
    }
}
