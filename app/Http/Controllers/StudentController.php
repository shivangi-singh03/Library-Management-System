<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Exception;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        try
        {
            $students=Student::paginateData();
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        $data = compact('students');
        return view('student.index')->with($data);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(StudentRequest $request)
    {
        $request->validate();
        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        try
        {
            Student::addStudent($name, $email, $password);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect('student');
    }

    
    public function edit($id)
    {
        if(!empty($id))
        {
            try
            {
                $student = Student::editStudent($id);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
            $u = url('student.edit')."/".$id;
            $data = compact('student','u');
            return view('student.edit')->with($data);
        }
    }

    public function update($id, Request $request)
    {
        if(!empty($id))
        {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            try
            {
                Student::updateStudent($id, $name, $email, $password);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
            return redirect('student');
        }
    }

    public function destroy($id)
    {
        if(!empty($id))
        {
            try
            {
                $data = Student::deleteStudent($id);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
            return redirect('student');
        }
    }
}