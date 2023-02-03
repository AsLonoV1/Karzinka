@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Category___</h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content  me-auto"> 
                    <button type="button" class="btn btn-success ">{{ Auth::User()->firstName}}</button>
                    <a href="{{ route('logout')}}"><button type="button" class="btn btn-outline-danger">Log out</button></a>
                    {{-- <a class="btn btn-info"><i class="bi bi-{{$report->soldChosen}}-circle"></i></a> --}}
                    <button type="button" class="btn btn-info">{{$report->soldChosen}} </button>
                    <button type="button" class="btn btn-light">{{$report->soldSumm}} $</button>
                </div>
              
            <a href="{{ route('usersPage')}}"><button type="button" class="btn btn-warning ">Users</button></a>
            <a href="{{ route('productSold')}}"><button type="button" class="btn btn-warning ">Placing an order</button></a>
            <a href="{{ route('productCreateAll')}}"><button type="button" class="btn btn-success">create product</button></a>
            <a href="{{ route('categoryCreate')}}"><button type="button" class="btn btn-success">create category</button></a>
        </div>
<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="col-md-1">T/R</th>
            <th >Catigories</th>
            <th class="col-md-1">Status</th>
            <th class="col-md-1">Chosen</th>
            <th class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>
                    <div class="d-grid gap-2">
                        <a href="{{ route('categoryProduct',$category->id)}}"><button class="btn btn-outline-secondary" type="button">{{ $category->categoryTitle }}</button></a>
                   </div>
            </td>
            <td>{{ $category->categoryStatus}}</td>
                <td>
                    <a class="btn btn-info"><i class="bi bi-{{$category->categoryChosen}}-circle"></i></a>
                </td>
            <td>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('categoryUpdate',$category->id)}}"><button type="button" class="btn btn-primary">Update</button></a>
                            <a href="{{ route('categoryDelete',$category->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- {{ $categories ->links()}} --}}
@endsection