@extends('layout.app')
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Student <b>Details</b></h2></div>
                    <div class="col-sm-4">
                         <a href="{{route('student.create')}}">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add New</button>
                        </a> 
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($students as $key=> $student)
                    <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip" href="{{route('student.edit',$student->id)}}"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip" href="student_delete/{{$student->id}}"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    
                    </tr>  
                    @endforeach    
                </tbody>
            </table>
            <div class="row">{{$students->links()}}</div>
            <div class="row">{{$students->currentPage()}}</div>
        </div>
    </div>
</div>     