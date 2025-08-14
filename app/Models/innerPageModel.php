<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class innerPageModel extends Model
{
     protected $table  = 'innerpages';
     protected $fillable = [
        'title', 'inner_image', 'youtube_link', 'audio_file', 'sequence' // Add 'sequence' here
    ];
    use HasFactory;
}
