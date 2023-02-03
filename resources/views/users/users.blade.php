@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Users___</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content  me-auto"> 
                    <button type="button" class="btn btn-success ">{{ Auth::User()->firstName}}</button>
                    <a href="{{ route('logout')}}"><button type="button" class="btn btn-outline-danger">Log out</button></a>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content "> 
                    <a href="{{ route('categoryPage')}}"><button type="button" class="btn btn-warning ">Category</button></a>
                   <a href="{{ route('allProducts')}}"> <button type="button" class="btn btn-warning ">Products</button></a>
                   <a href="{{ route('achot')}}"><button type="button" class="btn btn-warning ">Achot</button></a>
                </div> 
            <a href="{{ route('usersCreate')}}"><button type="button" class="btn btn-success">create</button></a>
        </div>
<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>T/R</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone</th>
            <th class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ (( $users->currentpage()-1)*$users->perpage()+($loop->index+1)) }}</td>
            <td>{{ $user->firstName }}</td>
            <td>{{ $user->lastName}}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('usersUpdate',$user->id)}}"><button type="button" class="btn btn-primary">Update</button></a>
                            <a href="{{ route('usersDelete',$user->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users ->links()}}

@endsection