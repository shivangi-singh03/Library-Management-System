@extends('layout.app')
@extends('layout.std_nav')
@section('content')
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Your <b>Details</b></h2></div>
                    
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Issue</th>
                    </tr>
                </thead>
        <tbody>
            @foreach($student as $data)
            <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->password}}</td>
            <td><button type="button">
            <a href = '/issue/{{ $data->id }}'>Issue Books</a></button></td>
            </tr>
            @endforeach
        </tbody>

        </table>
         </div>
         <div class="col-sm-4">
         <!-- <a href="/issue">
         <button type="button" class="btn btn-info add-new">Issue Book</button>
         </a> -->
         </div>
    
</div>
</div>
@endsection
