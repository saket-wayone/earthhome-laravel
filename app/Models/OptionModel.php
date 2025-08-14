<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{

    protected $table = 'options';

    use HasFactory;

    public function question()
    {
        return $this->belongsTo(QuestionModel::class, 'question_id');
    }
}
