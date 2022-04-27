<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table="students";
    protected $primaryKey="id";
    protected $filllable=['name','email','password'];
    protected $dates=['created_at','updated_at'];

    public static function register($name,$email,$password)
    {
        $c=new Student();
        $c->name=$name;
        $c->email=$email;
        $c->password=$password;

        $c->save();
    }

    public static function login($email,$password,$request)
    {
        $check=Student::where(['email'=>$email,'password'=>$password])->get();
        if(count($check)>0)
        {
            $data=$check;
            $request->session()->put('email',$email);
            $data=compact('student');
            return $data;
        }
        else
        {
            return;
        }
    }

    public static function edit($id)
    {
        $student=Student::find($id);
        $u=url('student.edit')."/".$id;
        $data=compact('student','u');
        return $data;
    }

    public static function updt($id,$request)
    {
        $res=Student::find($id);
        $res->name=$request->input('name');
        $res->email=$request->input('email');
        $res->password=$request->input('password');
        $res->save();
    }

    public static function store($name,$email,$password)
    {
    $res=new Student;
    $res->name=$name;
    $res->email=$email;
    $res->password=$password;
    $res->save();
    }

    public static function del($id)
    {
        Student::find($id)->delete();
    }
}
