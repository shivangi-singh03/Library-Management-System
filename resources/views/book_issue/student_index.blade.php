@extends('layout.app')
@extends('layout.std_nav')
@section('content')
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Issue <b>Books</b></h2></div>
                    <tr>
                    <td>
                     <a href = '/book_issue.issue'>
                        <button type="button" class="btn btn-info add-new">Issue</button>
                         </a> 
                        </td>
                        <td>
                        <a href="{{url('/')}}/book_issue.reissue">
                        <button type="button" class="btn btn-info add-new">Re-issue</button>
                        </a>
                        </td>
                    </tr>  
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($books as $key=> $book)
                    <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->category}}</td>
                    
                    </tr>  
                    @endforeach    
                </tbody>
            </table>
        <div class="row">{{$books->links()}}</div>
        <div class="row">{{$books->currentPage()}}</div>
        </div>
    </div>
</div>     
@endsection