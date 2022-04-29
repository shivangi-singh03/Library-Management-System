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
        $students=Student::paginateData();
        $data=compact('students');
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
        $data = Student::editStudent($id);
        if(empty($data))
        {
            throw new Exception("Data missing");
        }
        return view('student.edit')->with($data);
    }

    public function update($id,Request $request)
    {
        $data = Student::updateStudent($id, $request);
        return redirect('student');
    }

    public function destroy($id)
    {
        try
        {
            $data = Student::deleteStudent($id);
            if(empty($data))
            {
                throw new Exception("Data missing");
            }
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