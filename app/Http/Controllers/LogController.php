<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LogRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Exception;
use App\Student;
use App\Admin;
use App\Log;

class LogController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $data = Log::studentDetails();
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
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

    public function issue()
    {
        if(session()->has('email'))
        {
        return view('book_issue.issue');
        }
        return view('login');
    }
    
    

    public function store(LogRequest $request)
    {
        $request->validate();

        $s_id = $request->input('s_id');
        $title = $request->input('title');
        $issue_date = $request->input('issue_date');
        $return_date = $request->input('return_date');
        try
        {
            Log::bookIssue($s_id, $title, $issue_date, $return_date);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return "Issued";
    }


    public function studentInformation(Request $request)
    {
        try
        {
            $student = Student::studentInformation($request);
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


    public function reissueView()
    {
        if(session()->has('email'))
        {
        return view('book_issue.reissue');
        }
        return view('login');
    }

    public function reissue(Request $request)
    {
        $s_id = $request->input('s_id');
        $title = $request->input('title');
        $issue_date = $request->input('issue_date');
        $return_date = $request->input('return_date');
        try
        {
            Log::reissueBook($s_id, $title, $issue_date, $return_date);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return "Reissued";
    }
   
}
