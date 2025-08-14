<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo(SourceModel::class,'category','id');
    }
    public function before(){
        return $this->hasMany(TaskPhotos::class, 'task_id', 'id')->where('title','before');
    }

    public function after()
    {
        return $this->hasMany(TaskPhotos::class, 'task_id', 'id')->where('title', 'after');
    }
}
