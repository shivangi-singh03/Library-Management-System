<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table="students";
    protected $primaryKey="id";
    protected $filllable=['name','email','password'];
    protected $dates=['created_at','updated_at'];

    public static function paginateData()
    {
        $students = Student::paginate(3);
        return $students;
    }
    
    public static function studentRegister($name, $email, $password)
    {
        if((empty($name)) && (empty($email)) && (empty($password)))
        {
            return null;
        }
        $registration = new Student();
        $registration->name = $name;
        $registration->email = $email;
        $registration->password = $password;

        return $registration->save();
    }

    public static function login($email, $password)
    {
        if((empty($email)) && (empty($password)))
        {
            return null;
        }
        return Self::where(['email'=>$email,'password'=>$password])
                       ->get();
    }

    public static function viewStudent($email, $password)
    {
        if((empty($email)) && (empty($password)))
        {
            return null;
        }
        return Self::where(['email'=>$email,'password'=>$password])
                      ->get();
    }

    public static function editStudent($id)
    {
        if(empty($id))
        {
            return null;
        }
        return Self::find($id);
    }

    public static function updateStudent($id, $name, $email, $password)
    {
        if((empty($id)) && (empty($name)) && (empty($email)) && (empty($password)))
        {
            return null;
        }
        return Student::where('id', $id)
                       ->update([
                                'name' => $name, 
                                'email' => $email, 
                                'password' => $password
                                ]);
    }

    public static function addStudent($name, $email, $password)
    {
        if(empty($name) && (empty($email)) && (empty($password)))
        {
            return null;
        }
        $student = new Student;
        $student->name = $name;
        $student->email = $email;
        $student->password = $password;
        return $student->save();
    }

    public static function deleteStudent($id)
    {
        if(empty($id))
        {
            return null;
        }
        $data = Self::where('id', $id)->delete();
        return $data;
    }
}
