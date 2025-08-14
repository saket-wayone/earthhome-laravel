<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getdata($role){
        return User::where('role',$role)->orderby('id','desc')->get();
    }
    public static function editfunction($data){
        return User::where('id',$data)->first();
    }
    public static function notapproved($role='admin',$data){
        return User::where('role','!=',$role)->where('flag',$data)->get();
    }

    public static function getcount($role,$data){
        return User::where('flag',$data)->
        where('role','!=',$role)->count();
    }

    public static function getCompaniesUser($condition,$value, $role){
        return User::where($condition,$value)->where('role',$role)->orderby('id','desc')->get();
    }

    public static function getcompanyname($companyId){
        return User::where('id',$companyId)->first();
    }


 



}
