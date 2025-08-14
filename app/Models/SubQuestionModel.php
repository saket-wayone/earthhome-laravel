<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubQuestionModel extends Model
{
    protected $table ='subquestions';

    use HasFactory;

    public function question()
    {
        return $this->belongsTo(QuestionModel::class, 'question_id');
    }

    public function options()
    {
        return $this->hasMany(OptionModel::class, 'subquestion_id');
    }
}
