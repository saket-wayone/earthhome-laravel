<?php

use App\Models\leadModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('top5sales')) {
    function top5sales()
    {
        return "sasa";
    }
}


if (!function_exists('getLeadsCount')) {
    function getLeadsCount($data)
    {
     

        $query = leadModel::with(['assignleads.user'])->where('is_duplicate', 0);

        if (Auth::user()->role != 'admin') {
            $userId = Auth::user()->id;
            $query->whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            });
        }



        if (isset($data)) {
            if ($data == "today") {
                $query->whereHas('assignleads', function ($q) use ($userId) {
                    $q->where('employee_id', $userId);
                    $q->whereDate('created_at', now());
                });
            } else {
                $query->whereIn('leads.status', [$data]);
            }
        }
       


        return $query->orderby('leads.id', 'desc')->count();
    }
}
