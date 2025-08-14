<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignLead extends Model
{
    protected  $table = 'assignleads';
    protected $fillable  = ['employee_id','lead_id','assign_by','id','created_at','updated_at','status'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
