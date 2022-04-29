<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="admins";
    protected $primaryKey="id";

    public static function adminLogin($email, $password)
    {
        if(!empty($email) && (!empty($password)))
        {
            return Admin::where(['email'=>$email,'password'=>$password])->get();
        }
    }

}
