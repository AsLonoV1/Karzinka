@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Sold Products___</h1>

                <div class="d-grid gap-2 d-md-flex justify-content  me-auto"> 
                    <a href="{{ route('logout')}}"><button type="button" class="btn btn-outline-danger">Log out</button></a>
                </div>
<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="col-md-1">T/R</th>
            <th>Products</th>
            <th>Amout</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solds as $sold)
        <tr>
            <td>{{ ($loop->index+1) }}</td>
            <td>{{ $sold->productName }}</td>
            <td>{{ $sold->productAmout}}</td>
            <td>{{ $sold->productChosen }}</td>
        </tr>
        @endforeach
    </tbody>
    <tr>
        <th class="col-md-1">For</th>
        <th>{{$user->firstName}}</th>
        <th>{{$report->soldSumm}}</th>
        <th>{{$report->soldChosen}}</th>
    </tr>
   
</table>
{{ $solds ->links()}}
@endsection