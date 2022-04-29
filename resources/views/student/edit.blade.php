@extends('layout.app')
        <form action="{{route('student_update',[$student->id])}}" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Edit Student Details</h1>
           <div class="form-group">
               <label for="Name">Name</label>
               <input type="text" name="name" id="" class="form-control" placeholder="" required value="{{$student->name}}"/>
            </div>

            <div class="form-group">
               <label for="Email">Email</label>
               <input type="email" name="email" id="" class="form-control" placeholder="" required value="{{$student->email}}"/>
            </div>

            <div class="form-group">
               <label for="Password">Password</label>
               <input type="password" name="password" id="" class="form-control" placeholder="" required value="{{$student->password}}"/>
            </div>

            <button class="btn-btn-primary">
             Save
            </button>

            
         </div>
        

