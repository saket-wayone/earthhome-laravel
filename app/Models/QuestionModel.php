<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';

    use HasFactory;

    public function subquestions()
    {
        return $this->hasMany(SubQuestionModel::class, 'question_id')->with('options');
    }


    public function options()
{
    return $this->hasMany(OptionModel::class, 'question_id');
}
   
}
