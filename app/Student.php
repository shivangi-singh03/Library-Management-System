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
        if((!empty($name)) && (!empty($email)) && (!empty($password)))
        {
            $registration = new Student();
            $registration->name = $name;
            $registration->email = $email;
            $registration->password = $password;

            return $registration->save();
        }
    }

    public static function login($email, $password)
    {
        if((!empty($name)) && (!empty($email)))
        {
            return Student::where(['email'=>$email,'password'=>$password])
            ->get();
        }
    }

    public static function viewStudent()
    {
        return Student::where(['email'=>$email,'password'=>$password])
        ->get();
    }

    public static function editStudent($id)
    {
        $student = Student::find($id);
        $u = url('student.edit')."/".$id;
        $data = compact('student','u');
        return $data;
    }

    public static function updateStudent($id)
    {
        $student = Student::find($id);
        return $student;
    }

    public static function addStudent($name, $email, $password)
    {
        if(!empty($name) && (!empty($email)) && (!empty($password)))
        {
            $student = new Student;
            $student->name = $name;
            $student->email = $email;
            $student->password = $password;
            return $student->save();
        }
    }

    public static function deleteStudent($id)
    {
        $data = Student::where('id', $id)->delete();
        return $data;
    }
}
