<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    protected $table = 'status';
    use HasFactory;


    public static function editfunction($data){
        return StatusModel::where('id',$data)->first();
    }
}
