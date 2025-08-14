<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leadModel extends Model
{
    protected $table='leads';
    protected $fillable= ['name','email','phone','funds','demate','status','source','description','city','unique_id','created_at','updated_at','is_duplicate'];

    use HasFactory;

    public static function editfunction($data){
        return leadModel::where('id',$data)->first();
    }

    public function assignleads()
    {
        return $this->hasOne(AssignLead::class, 'lead_id', 'id');
    }
    public function firms()
    {
        return $this->hasOne(Firm::class, 'id', 'firm');
    }

    public function assignedUser()
    {
        return $this->hasOneThrough(User::class, AssignLead::class, 'lead_id', 'id', 'id', 'employee_id');
    }

    public function  user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
}
