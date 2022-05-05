@extends('layout.app')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>
        <form action="{{url('/')}}/r" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Registration</h1>
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

            <label for=""><b>Designation</b></label>
         
           <select name="designation" id="designation">
         
           <option value="Admin">Admin</option>
           <option value="Student">Student</option>
           </select>
          <br><br>

            <button class="btn-btn-primary">
             Submit
            </button>

            
         </div>
        </form>

    </body>

