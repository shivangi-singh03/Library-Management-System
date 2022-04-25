<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
      try
      {
        $students=Student::paginate(3);
        $data=compact('students');
        return view('student.index')->with($data);
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function create()
    {
      try
      {
        return view('student.create');
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function store(StudentRequest $request)
    {
      try
      {
        $request->validate();
        
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');

        Student::store($name,$email,$password);

        return redirect('student');
       }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    
    public function edit($id)
    {
      try
      {
        $data=Student::edit($id);
        return view('student.edit')->with($data);
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function update($id,Request $request)
    {
      try
      {
        Student::updt($id,$request);
        return redirect('student');
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function destroy($id)
    {
      try
        {
        Student::del($id);
        return redirect('student');
        }
      catch(\Exception $exception)
        {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
        }
    }

     public function view()
     {
      try
        {
        $students=Student::paginate(1);
        $data=compact('students');
        return view('s_issue.s_index')->with($data);
        }
      catch(\Exception $exception)
        {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
     }
}