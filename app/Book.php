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

    public static function paginateData()
    {
        $books = Book::paginate(3);
        return $books;
    }
    
     public static function searchBook($search)
    {
        $books = Book::where('title','=',$search)->orWhere('category','=',$search)
        ->get();
        return $books;
    }

    public static function editBook($id)
    {
        $book = Book::find($id);
        $u=url('book.edit')."/".$id;
        $data=compact('book','u');
        return $data;
    }

    public static function updateBook($id, $title, $author, $category)
    {
        return Book::where('id', $id)->update(['title' => $title, 'author' => $author, 'category' => $category]);
    }

    public static function addBook($title, $author, $category)
    {
        if((!empty($title)) && (!empty($author)) && (!empty($category)))
        {
            $book = new Book;
            $book->title = $title;
            $book->author = $author;
            $book->category = $category;
            return $book->save();
        }
    }

    public static function deleteBook($id)
    {
        $data = Book::where('id', $id)->delete();
        return $data;
    }
    
}
