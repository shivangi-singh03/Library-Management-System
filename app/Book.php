<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table="books";
    protected $primaryKey="id";
    protected $filllable=['title','author','category'];
    protected $dates=['created_at','updated_at'];

    public static function edit($id)
    {
        $book=Book::find($id);
        $u=url('panel.edit')."/".$id;
        $data=compact('book','u');
        return $data;
    }

    public static function updt($id,$request)
    {
        $res=Book::find($id);
        $res->title=$request->input('title');
        $res->author=$request->input('author');
        $res->category=$request->input('category');
        $res->save();
    }

    public static function store($title,$author,$category)
    {
    $res=new Book;
    $res->title=$title;
    $res->author=$author;
    $res->category=$category;
    $res->save();
    }

    public static function del($id)
    {
        Book::find($id)->delete();
    }
    
}
