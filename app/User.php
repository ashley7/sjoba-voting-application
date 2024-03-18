<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function saveUser($name,$phone_number,$pin,$user_type)
    {
        $saveUser = new User();        

        $saveUser->name = $name;        

        $checkUser = User::where('phone_number',$phone_number)->count();

        $saveUser->phone_number = $phone_number;

        $saveUser->email_verified_at = now();

        $saveUser->password = Hash::make($pin);

        $saveUser->pin = $pin;

        $saveUser->user_type = $user_type;

        $saveUser->remember_token = \Str::random(32);

        if($checkUser == 0){

            $saveUser->save();

            return $saveUser;

        } else{
            return [];
        }
    }


    public static function validatePhoneNumber($phone)
    {
        $phone_number = "";

        if ($phone[0]=="+") {

           $phone_number=$phone;

        }elseif ($phone[0]=="0") {

            $out = ltrim($phone, "0");

            $phone_number="+256".$out;

        }else{

            $phone_number=$phone;
            
        }

        return $phone_number;
    }

    public static function uploadFile($file)
    {
       $destinationPath = public_path('files');

       $file_url =\Str::random(12).''.time().'.'.$file->getClientOriginalExtension();

       $file->move($destinationPath,$file_url);
       
       return $file_url;
    }
}
