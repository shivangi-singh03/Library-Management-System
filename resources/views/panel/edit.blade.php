@extends('layout.app')
        <form action="{{route('p_update',[$book->id])}}" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Edit Book Details</h1>
           <div class="form-group">
               <label for="Title">Title</label>
               <input type="text" name="title" id="" class="form-control" placeholder="" required value="{{$book->title}}"/>
            </div>

            <div class="form-group">
               <label for="Author">Author</label>
               <input type="text" name="author" id="" class="form-control" placeholder="" required value="{{$book->author}}"/>
            </div>

            <div class="form-group">
               <label for="Category">Category</label>
               <input type="text" name="category" id="" class="form-control" placeholder="" required value="{{$book->category}}"/>
            </div>

            <button class="btn-btn-primary">
             Save
            </button>

            
         </div>
        

