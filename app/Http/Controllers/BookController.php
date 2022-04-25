<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        try
        {
            $search=$request['search']??"";
            if($search!="")
            {
              $books=Book::index($request);
            }
            else
            {
              $books=Book::all();
            }
            $data=compact('books','data');
            return view('panel.index')->with($data);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

   
    public function create()
    {
        try
        {
            return view('panel.create');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function store(BookRequest $request)
    {
        try
        {
              $request->validate();
              
              $title=$request->input('title');
              $author=$request->input('author');
              $category=$request->input('category');

              Book::store($title,$author,$category);

              return redirect('panel');
        }
        catch(\Exception $exception)
        {
              return view('error')->with
              (
              'error',$exception->getMessage()
              );
        }
    }

    public function show(Book $book)
    {
        try
        {
            return view('s_issue.s_index');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function edit(Book $book,$id)
    {
        try
        {
            $data=Book::edit($id);
            return view('panel.edit')->with($data);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function update($id,Request $request)
    {
        try
        {
            Book::updt($id,$request);
            return redirect('panel');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function destroy(Book $book,$id)
    {
        try
        {
            Book::del($id);
            return redirect('panel');
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

     public function view($id)
     {
         try
         {
            $books=Book::paginate(3);
            $data=compact('books');
            return view('s_issue.s_index')->with($data);
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
