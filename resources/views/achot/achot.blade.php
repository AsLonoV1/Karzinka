@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Achot___</h1>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="d-grid gap-2 d-md-flex justify-content  me-auto"> 
        <button type="button" class="btn btn-success ">{{ Auth::User()->firstName}}</button>
        <a href="{{ route('logout')}}"><button type="button" class="btn btn-outline-danger">Log out</button></a>
    </div>
    <a href="{{ route('usersPage')}}"><button type="button" class="btn btn-warning ">Users</button></a>

</div>
<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="col-md-1">T/R</th>
            <th>Users</th>
            <th>Amout</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($achots as $achot)
        <tr>
            <td>{{ ($loop->index+1) }}</td>
            <td>{{ $achot->userName }}</td>
            <td>{{ $achot->achotSumm}}</td>
            <td>{{ $achot->created_at }}</td>
            <td>{{ $achot->updated_at}}</td>
        </tr>
        @endforeach
    </tbody>
   
</table>
{{$achots->links()}}
@endsection