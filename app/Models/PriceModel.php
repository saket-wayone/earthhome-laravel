<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceModel extends Model
{
    protected $table ='prices';
    protected $fillable = [
        'type',
        'price',
    ];
    use HasFactory;

    public static function editfunction($data){
        return PriceModel::where('id',$data)->first();
    }
    
}
