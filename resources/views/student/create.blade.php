@extends('layout.app')
        <form action="{{url('/')}}/student.create" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Add Student</h1>
           <div class="form-group">
               <label for="Name">Name</label>
               <input type="text" name="name" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="Email">Email</label>
               <input type="email" name="email" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="Password">Password</label>
               <input type="password" name="password" id="" class="form-control" placeholder="">
            </div>

            <button class="btn-btn-primary">
             Save
            </button>

            
         </div>
        

