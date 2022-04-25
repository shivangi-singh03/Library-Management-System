@extends('layout.app')
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Student <b>Info</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>BookId</th>
                        <th>Book Name</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                
                <tbody>

                @foreach($data as $row)
                    <tr>
                    <td>{{ $row->s_id }}</td>  
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->title }}</td>
                    <td>{{ $row->issue_date }}</td>
                    <td>{{ $row->return_date }}</td>
                    @php
                    $days=0;
                    $fine=0;
                    $d=0;
                    $datetime1 = strtotime($row->issue_date);
                    $datetime2 = strtotime($row->return_date);
                    $days = (int)(($datetime2 - $datetime1)/86400);

                    if($days>7)
                    $d=$days-7;
                    $fine=$d*5;

                    @endphp
                
                
                    <td>{{$fine}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $data->appends($_GET)->links() }}
        </div>
    </div>
</div>     