<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
 use App\Student;
 use App\Admin;
 use App\Log;

class LogController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $data = Log::index();
            $filter_data = []; 
            foreach($data as $row)
            {
                array_push($filter_data, $row);
            }
            $count = count($filter_data); 
            $page = $request->page; 
            $perPage = 3;
            $offset = ($page-1) * $perPage;
            $data = array_slice($filter_data, $offset, $perPage);
            $data = new Paginator($data, $count, $perPage, $page, ['path'  => $request->url(),'query' => $request->query(),]);
            return view('details',['data' => $data]);
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
    
    

     public function store(LogRequest $request)
    {
        try
        {
            $request->validate();

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
