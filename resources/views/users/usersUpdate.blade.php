@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Update User___</h1>
<br>
<br>
<div class="row">
    <div class="col-md-6">
       <form   method="post" action="{{ route('usersUpdate',$users->id)}}">
          @csrf
          <div class="mb-3">
            <label for="firstName" class="form-label">First name</label>
            <input type="text" class="form-control" name="firstName" value="{{$users->firstName}}" >
                    </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Sure name</label>
                <input type="text" class="form-control" name="lastName" value="{{$users->lastName}}">
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control"  name="email" value="{{$users->email}}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control"   name="phone" value="{{$users->phone}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control"   name="password">
            </div>     
 <div class="d-grid gap-2 col-6 mx-auto-end">
   <button class="btn btn-success " type="submit">Save</button>
 </form>
 </div>
 </div>


@endsection