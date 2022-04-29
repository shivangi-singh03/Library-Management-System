<?php

namespace App;
use Exception;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table="books";
    protected $primaryKey="id";
    protected $filllable=['title','author','category'];
    protected $dates=['created_at','updated_at'];

    /**
     * @param String $title
     * @param String $author
     * @param String $category
     */

    public static function searchBook($request)
    {
        $search = $request['search']??"";
        $books = Book::where('title','=',$search)->orWhere('category','=',$search)->get();
        return $books;
    }

    public static function editBook($id)
    {
        $book = Book::find($id);
        $u=url('panel.edit')."/".$id;
        $data=compact('book','u');
        return $data;
    }

    public static function updateBook($id, $request)
    {
        $book = Book::find($id);
        $book->title=$request->input('title');
        $book->author=$request->input('author');
        $book->category=$request->input('category');
        $book->save();
    }

    public static function addBook($title, $author, $category)
    {
        $book = new Book;
        $book->title = $title;
        $book->author = $author;
        $book->category = $category;
        $book->save();
    }

    public static function deleteBook($id)
    {
        $data = Book::where('id', $id)->delete();
        return $data;
    }
    
}
