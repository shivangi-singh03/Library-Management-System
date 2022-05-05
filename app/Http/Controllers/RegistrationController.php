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

    public function loginView()
    {
        if(session()->has('email'))
        {
            return redirect('student-view');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if((!empty($email)) && (!empty($password)))
        {
            try
            {
                $student = Student::login($email, $password);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
            if(isset($student))
            {
                if(count($student)>0)
                {
                    $request->session()->put('email',$email);
                    $data = compact('student');
                    return view('student-view')->with($data);
                }
            }
            else
            {
                return redirect('login');
            }
        }
    }    

    public function adminView()
    {
        if(session()->has('email'))
        {
        return redirect('layout.admin_nav');
        }
        return view('adminLogin');
    }
    

    public function adminLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if((!empty($email)) && (!empty($password)))
        {
            try
            {
                $data = Admin::adminLogin($email, $password);
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
                if(count($data)>0)
                {
                    $request->session()->put('email',$email);
                    $data = compact('admin');
                    return redirect('layout.admin_nav');
                }
            }
            else
            {
                return redirect('adminLogin');  
            }
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
            return redirect('adminLogin');
        }
        return view('layout.admin_nav');
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

