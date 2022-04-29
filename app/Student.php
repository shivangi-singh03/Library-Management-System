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
        $students=Student::paginate(3);
        return $students;
    }
    
    public static function studentRegister($name, $email, $password)
    {
        $registration = new Student();
        $registration->name = $name;
        $registration->email = $email;
        $registration->password = $password;

        $registration->save();
    }

    public static function login($email, $password)
    {
        return Student::where(['email'=>$email,'password'=>$password])->get();
    }

    public static function viewStudent()
    {
        return Student::where(['email'=>$email,'password'=>$password])->get();
    }

    public static function editStudent($id)
    {
        $student = Student::find($id);
        $u = url('student.edit')."/".$id;
        $data = compact('student','u');
        return $data;
    }

    public static function updateStudent($id, $request)
    {
        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = $request->input('password');
        $student->save();
    }

    public static function addStudent($name, $email, $password)
    {
        $student = new Student;
        $student->name = $name;
        $student->email = $email;
        $student->password = $password;
        $student->save();
    }

    public static function deleteStudent($id)
    {
        $data = Student::where('id', $id)->delete();
        return $data;
    }
}
