<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Student;
use App\Admin;
use App\Log;

class RegistrationController extends Controller
{
    public function index()
    {
      try
      {
        return view('signup');
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function register(RegistrationRequest $request)
    {
      try
      {
        $request->validate();
      
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');

        Student::register($name,$email,$password);

        return redirect('login');
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
        $student=Student::where(['email'=>$email,'password'=>$password])->get();
        $data=compact('student');
        return view('student-view')->with($data);
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function loginview()
    {
      try
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
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function login(Request $request)
    {
      try
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
      catch(\Exception $exception)
      {
          return view('error')->with
          (
          'error',$exception->getMessage()
          );
      }
    }

    public function adminview()
    {
       try
       {
          if(session()->has('email'))
          {
          return redirect('layout.admin_nav');
          }
          return view('adminlogin');
        }
        catch(\Exception $exception)
        {
          return view('error')->with
          (
          'error',$exception->getMessage()
          );
        }
    }
    

    public function adminlogin(Request $request)
    {
      try
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
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function nav()
    {
      try
      {
        return view('layout.navbar');
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }

    public function adnav()
    {
      try
      {
        if(!session()->has('email'))
        {
          return redirect('adminlogin');
        }
        else{
          return view('layout.admin_nav');
        }
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

