@extends('layout.app')
@extends('layout.admin_nav')
@section('content')
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Books <b>Details</b></h2></div>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <div class="col-sm-4">
                        <a href="{{route('book.create')}}">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add New</button>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($books as $key=> $book)
                    <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->category}}</td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip" href="{{route('book.edit',$book->id)}}"><i class="material-icons">&#xE254;</i></a>
                        </td>
                        <td style="background-color:#e9b0b3;">
                            <form action="/book_delete/{{ $book->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id">
                            <button button style="background-color:#f09797;" type="submit">Delete</button>
                            </form></td>
                    </tr>  
                    @endforeach    
                </tbody>
            </table>
            
        </div>
    </div>
</div>     
@endsection