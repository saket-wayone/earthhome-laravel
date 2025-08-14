<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Leads;

class ProjectQuotation extends Model
{
    protected $table  = 'project_quotations';

    function phasename()
    {
        return $this->belongsTo(Phase::class ,'phase_id');
        
    }
    function leadInfo()
    {
        return $this->belongsTo(Leads::class ,'lead_id');
        
    }
    use HasFactory;
}
