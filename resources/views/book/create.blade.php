@extends('layout.app')
        <form action="{{url('/')}}/book.create" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Add Book</h1>
           <div class="form-group">
               <label for="Title">Title</label>
               <input type="text" name="title" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="Author">Author</label>
               <input type="text" name="author" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="Category">Category</label>
               <input type="text" name="category" id="" class="form-control" placeholder="">
            </div>

            <button class="btn-btn-primary">
             Save
            </button>

            
         </div>
        

