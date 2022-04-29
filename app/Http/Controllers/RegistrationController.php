<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;
use Exception;
use App\Student;
use App\Admin;
use App\Log;

class RegistrationController extends Controller
{
    /**
     * @param String $name
     * @param String $email
     */


    public function index()
    {
        return view('signup');
    }

    public function register(RegistrationRequest $request)
    {
        $request->validate();
      
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        try
        {
            Student::studentRegister($name, $email, $password);
            if(empty($name) || empty($email) || empty($password))
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
        return redirect('login');
    }

    public function view()
    {
        try
        {
            $student = Student::viewStudent();
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        $data = compact('student');
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
        $email = $request->input('email');
        $password = $request->input('password');
        try
        {
            $data = Student::login($email, $password);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        if(isset($data))
        {
            $dat = $request->input('email');
            $request->session()->put('email',$dat);
            $data = compact('student');
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
        $email = $request->input('email');
        $password = $request->input('password');
        try
        {
            $data = Admin::adminlogin($email, $password);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        if(isset($data))
        {
            $dat = $request->input('email');
            $request->session()->put('email',$dat);
            $data = compact('admin');
            return redirect('layout.admin_nav');
        }
        else
        {
            return redirect('adminlogin');  
        }
    }

    public function navbar()
    {
        return view('layout.navbar');
    }

    public function adminNavbar()
    {
        if(!session()->has('email'))
        {
            return redirect('adminlogin');
        }
        else
        {
            return view('layout.admin_nav');
        }
    }

    public function logout()
    {
        if(session()->has('email'))
        {
            session()->pull('email');
            session::flush();
        }
        return redirect('/');
    }

}

