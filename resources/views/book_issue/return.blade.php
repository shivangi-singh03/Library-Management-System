@extends('layout.app')
        <form action="{{url('/')}}/book_issue.return" method="post">
        {{csrf_field()}}

         <div class="container">
          <h1 class="text-center">Return Book</h1>
          <div class="form-group">
               <label for="StudentId">Student Id</label>
               <input type="number" name="s_id" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="StudentId">Book Id</label>
               <input type="number" name="s_id" id="" class="form-control" placeholder="">
            </div>

            <div class="form-group">
               <label for="return_date">Return Date</label>
               <input type="date" name="return_date" id="" class="form-control" placeholder="">
            </div>

            <button class="btn-btn-primary">
             Save
            </button>

            
         </div>
</form>
        