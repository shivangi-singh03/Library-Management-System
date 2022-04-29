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
        if(!empty($search))
        {
            try
            {
                $books=Book::searchBook($search);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
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
        if(!empty($id))
        {
            try
            {
                $data = Book::editBook($id);
            }
            catch(\Exception $exception)
            {
                return view('error')->with
                (
                'error',$exception->getMessage()
                );
            }
            return view('book.edit')->with($data);
        }
    }

    public function update($id, Request $request)
    {
        if(!empty($id))
        {
            $book->title=$request->input('title');
            $book->author=$request->input('author');
            $book->category=$request->input('category');
            try
            {
                $data = Book::updateBook($id);
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
    }

    public function destroy($id)
    {
        if(!empty($id))
        {
            try
            {
                $data = Book::deleteBook($id);
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
    }

    public function view($id)
    {
        if(!empty($id))
        {
            try
            {
                $books=Book::paginateData();
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
     
}
