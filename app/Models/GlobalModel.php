<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GlobalModel extends Model
{
    use HasFactory;


    static public function getlastGFCode($table)
    {
        $code = 'EHLID-';
        if ($table == 'users') $code = 'EH-';

        $getlastid = DB::table($table)->orderBy('id', 'desc')->select('id', 'unique_id')->first();

        if (!empty($getlastid) && !empty($getlastid->unique_id)) {
            $unique_id = str_replace($code, "", (string) $getlastid->unique_id);
            $code = $code . ((int) $unique_id + 1);
        } else {
            $code = $code . "100";
        }

        return $code;
    }

    static public  function getDataOrderByiDesc($table, $where = '', $condtion = '', $third = '' ,$order='desc' ,$addby = false)
    {
        $query = DB::table($table)->orderBy('id', $order);
        if (!empty($where) && !empty($condtion) && $third == '') {
            $query->where($where, $condtion);
        }
        if (!empty($wehre) && !empty($condtion) && !empty($third)) {
            $query->where($where, $third, $condtion);
        }
        if($addby == true){
            $query->where('add_by',Auth::user()->id);
        }
        return $query->get();
    }

    static public  function getSingleData($table, $where = '', $condtion = '', $third = '')
    {
        $query = DB::table($table);
        if (!empty($where) && !empty($condtion) && $third == '') {
            $query->where($where, $condtion);
        }

        return $query->first();
    }

    
}
