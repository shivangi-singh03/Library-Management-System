<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Student;
 use App\Admin;
 use App\Log;

class LogController extends Controller
{
    function index()
    {
        try
        {
            $data = Log::index();
            return view('details', compact('data'));
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function issue()
    {
        try
        {
            if(session()->has('email'))
            {
            return view('s_issue.issue');
            }
            return view('login');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }
    
    

     public function store(Request $request)
    {
        try
        {
            $this->validate($request,['title'=>'required|string|max:255',
            'issue_date'=>'required',
            'return_date'=>'required',
            ]);
            $s_id=$request->input('s_id');
            $title=$request->input('title');
            $issue_date=$request->input('issue_date');
            $return_date=$request->input('return_date');

            Log::store($s_id,$title,$issue_date,$return_date);
            
            return "Issued";
       }
       catch(\Exception $exception)
       {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
       }
    }


    public function show(Request $request)
    {
        try
        {
            $student=Student::where('email',$request->input('email'))->get();
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


    public function reissueView()
    {
        try
        {
            if(session()->has('email'))
            {
            return view('s_issue.reissue');
            }
            return view('login');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function reissue(Request $request)
    {
        try
        {
            $s_id=$request->input('s_id');
            $title=$request->input('title');
            $issue_date=$request->input('issue_date');
            $return_date=$request->input('return_date');

            Log::updateBook($s_id,$title,$issue_date,$return_date);
            return "Reissued";
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
