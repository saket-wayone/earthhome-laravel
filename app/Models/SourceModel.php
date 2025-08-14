<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceModel extends Model
{
    
     protected $table = 'sources';
     protected $fillable = ['source'];

    use HasFactory;


    public static function editfunction($data){
        return SourceModel::where('id',$data)->first();
    }
    
}
