<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table="logs";
    protected $primaryKey="id";
    protected $filllable=['title','issue_date'];
    protected $dates=['created_at','updated_at'];

    public static function studentDetails()
    {
        $data = Student::select('logs.s_id','students.name', 'books.id', 'books.title', 'logs.issue_date','logs.return_date')
        ->join('logs', 'students.id', '=', 'logs.s_id')
        ->join('books', 'books.title', '=', 'logs.title')
        ->get();

        return $data;
    }

    public static function bookIssue($s_id, $title, $issue_date, $return_date)
    {
        $issue = new Log;
        $issue->s_id = $s_id;
        $issue->title = $title;
        $issue->issue_date = $issue_date;
        $issue->return_date = $return_date;
        $issue->save();
    }


    public static function reissueBook($s_id, $title, $issue_date, $return_date)
    {
        Log::where('s_id', $s_id)->update(['title' => $title, 'issue_date' => $issue_date, 'return_date' => $return_date]);
    }

    public static function studentInformation($request)
    {
        return Student::where('email',$request->input('email'))->get();
    }


}
