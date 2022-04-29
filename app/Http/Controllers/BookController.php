<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Exception;
use App\Book;

class BookController extends Controller
{
    /**
     * @param String $title
     * @param String $author
     * @param String $category
     */
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        if($search!="")
        {
            $books=Book::searchBook($request);
        }
        else
        {
            $books=Book::all();
        }
        $data=compact('books','data');
        return view('book.index')->with($data);
    }

   
    public function create()
    {
        return view('book.create');
    }

    public function store(BookRequest $request)
    {
        $request->validate();
        
        $title = $request->input('title');
        $author = $request->input('author');
        $category = $request->input('category');
        try
        {
            Book::addBook($title, $author, $category);
            if(empty($title) || empty($author) || empty($category))
            {
                throw new Exception("Data missing");
            }
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect('book');
    }

    public function show(Book $book)
    {
        return view('book_issue.student_index');
    }

    public function edit($id)
    {
        $data = Book::editBook($id);
        if(empty($data))
        {
            throw new Exception("Data missing");
        }
        return view('book.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $data = Book::updateBook($id, $request);
        return redirect('book');
    }

    public function destroy($id)
    {
        try
        {
            $data = Book::deleteBook($id);
            if(empty($data))
            {
                throw new Exception("Data missing");
            }
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect('book');
    }

    public function view($id)
    {
        try
        {
            $books=Book::paginate(3);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        $data = compact('books');
        return view('book_issue.student_index')->with($data);
    }
     
}
