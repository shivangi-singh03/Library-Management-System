<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table="logs";
    protected $primaryKey="id";
    protected $filllable=['title','issue_date'];
    protected $dates=['created_at','updated_at'];

    public static function index()
    {
        $data=Student::join('logs', 'students.id', '=', 'logs.s_id')
        ->join('books', 'books.title', '=', 'logs.title')
        ->select('logs.s_id','students.name', 'students.email', 'books.id', 'books.title', 'logs.issue_date','logs.return_date')
        ->get();

        return $data;
    }

    public static function store($s_id,$title,$issue_date,$return_date)
    {
    $res=new Log;
    $res->s_id=$s_id;
    $res->title=$title;
    $res->issue_date=$issue_date;
    $res->return_date=$return_date;
    $res->save();
    }


    public static function updateBook($s_id,$title,$issue_date,$return_date){
        Log::where('s_id', $s_id)->update(['title' => $title]);
        Log::where('s_id', $s_id)->update(['issue_date' => $issue_date]);
        Log::where('s_id', $s_id)->update(['return_date' => $return_date]);
     }


}
