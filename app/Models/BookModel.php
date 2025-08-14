<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table ='books';
    protected $fillable = [
        'company_id',
        'cover_image',
        'title'
    ];
    use HasFactory;
}
