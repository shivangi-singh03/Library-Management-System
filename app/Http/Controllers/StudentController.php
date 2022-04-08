<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students=Student::paginate(3);
        $data=compact('students');
        return view('student.index')->with($data);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required|string|max:255',
        'email'=>'required',
        'password'=>'required',
    ]);
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');

        Student::store($name,$email,$password);

        return redirect('student');
    }

    public function show(Student $student)
    {
        //return view('s_issue.s_index');
    }

    
    public function edit($id)
    {
        $data=Student::edit($id);
        return view('student.edit')->with($data);
    }

    public function update($id,Request $request)
    {
        Student::updt($id,$request);

        return redirect('student');
    }

    public function destroy($id)
    {
        Student::del($id);
        return redirect('student');
    }

     public function view()
     {
       $students=Student::paginate(1);
       $data=compact('students');
       return view('s_issue.s_index')->with($data);
     }
}