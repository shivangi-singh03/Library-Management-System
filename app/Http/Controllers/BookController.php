<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
          $books=Book::where('title','=',$search)->orWhere('category','=',$search)->get();
        }
        else
        {
          $books=Book::all();
        }
          $data=compact('books','data');
          return view('panel.index')->with($data);
    }

   
    public function create()
    {
        return view('panel.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required|string|max:255',
        'author'=>'required',
        'category'=>'required',
    ]);
    $title=$request->input('title');
    $author=$request->input('author');
    $category=$request->input('category');

    Book::store($title,$author,$category);

    return redirect('panel');
    }

    public function show(Book $book)
    {
        return view('s_issue.s_index');
    }

    public function edit(Book $book,$id)
    {
        $data=Book::edit($id);
        return view('panel.edit')->with($data);
    }

    public function update($id,Request $request)
    {
        Book::updt($id,$request);
        return redirect('panel');

    }

    public function destroy(Book $book,$id)
    {
        Book::del($id);
        return redirect('panel');
    }

     public function view($id)
     {
       $books=Book::paginate(3);
       $data=compact('books');
       return view('s_issue.s_index')->with($data);
     }
     
}
