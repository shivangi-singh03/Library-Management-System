<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="admins";
    protected $primaryKey="id";

    public static function adminlogin($email,$password,$request)
    {
        $check=Admin::where(['email'=>$email,'password'=>$password])->get();
        if(count($check)>0)
        {
            $admin=Admin::where(['email'=>$email,'password'=>$password])->get();
            $dat=$request->input('email');
            $request->session()->put('email',$dat);
            $data=compact('admin');
            return $data;
        }
        else
        {
            return;
        }
    }

}


