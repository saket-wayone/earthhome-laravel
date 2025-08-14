<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table='serviceagreement';
    protected $fillable = [
        'client_type',
        'clientname',
        'clientplace',
        'days',
        'months',
        'package',
        'packageamount',
        'paidamount',
        'discountamount',
        'discountpercentage',
        'balanceamount',
        'bookingprofitamount',
        'email',
        'mobile',
        'pancard',
        'investamount',
        'expirydate',
        'riskscore',
    ];
    use HasFactory;
}
