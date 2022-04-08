<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Admin;
use App\Log;

class RegistrationController extends Controller
{
    public function index()
    {

        return view('signup');
    }

    public function register(Request $request)
    {
        $request->validate(
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]
        );
      
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');

        Student::register($name,$email,$password);

        return redirect('login');
    }

    public function view()
    {
      $student=Student::where(['email'=>$email,'password'=>$password])->get();
      $data=compact('student');
      return view('student-view')->with($data);
    }

    public function loginview()
    {
        if(session()->has('email'))
        {
        return redirect('student-view');
        }
        else
        {
        return view('login');
       }  
      }

      public function login(Request $request)
      {
        $email=$request->input('email');
        $password=$request->input('password');

        $data=Student::login($email,$password,$request);
        if(isset($data))
        {
          return view('student-view')->with($data);
        }
        else
        {
          return redirect('login');
        }
      }

      public function adminview()
     {
        if(session()->has('email'))
        {
        return redirect('layout.admin_nav');
        }
        return view('adminlogin');
       }
    

      public function adminlogin(Request $request)
      {
      
        $email=$request->input('email');
        $password=$request->input('password');
      
         $data=Admin::adminlogin($email,$password,$request);
         if(isset($data))
         {
           return redirect('layout.admin_nav');
        
         }
         else
        {
            return redirect('adminlogin');
          
        }
      }

      public function nav()
      {
        return view('layout.navbar');
      }

       public function adnav()
       {
        if(!session()->has('email'))
        {
          return redirect('adminlogin');
        }
        else{
          return view('layout.admin_nav');
        }
       }

}

