<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;
use Exception;
use App\Student;

class NewRegistrationController extends Controller
{
    public function getnewsignup()
    {
        return view('newsignup');
    }

    public function storenewsignup(Request $request)
    {
        //$request->validate();
      
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $designation = $request->input('designation');
        try
        {
            $data = Student::newstudentRegister($name, $email, $password, $designation);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        echo $data;
    }

    public function loginView()
    {
        // if(session()->has('email'))
        // {
        //     return redirect('student-view');
        // }
        return view('newLogin');
    }


    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if((!empty($email)) && (!empty($password)))
        {
                $student = Student::login($email, $password);
                $data=Student::getEmployeeDetails($email);
                if(!empty($student))
                {
                if($data->designation != 'Admin')

                {

                    //return view('features')->with($users);
                    //return view('layout.admin_nav');
                }

                else

                {

                    //return view('afterlogin')->with($users);
                    return view('layout.admin_nav');

                }
                //return rediect('newLogin');
            
                 }
                }
            // }
            // catch(\Exception $exception)
            // {
            //     return view('error')->with
            //     (
            //     'error',$exception->getMessage()
            //     );
            // }
            // if(isset($student))
            // {
            //     $request->session()->put('email',$email);
            //     $data = compact('student');
            //     return view('student-view')->with($data);
            // }
            // else
            // {
            //     return redirect('newLogin');
            // }
            //return redirect('newLogin');
    }

    public function demo()
    {
        $email="admin@gmail.com";
        $data=Student::getEmployeeDetails($email);
    }

}
