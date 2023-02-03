@extends('users.app')
@section('content')
<br>
<h1 class="text-center">__Login__</h1>
<br>
<br>
<div class="row">
    <div class="col-md-6">
       <form   method="post" action="{{ route('usersLogin')}}">
          @csrf
 <div class="mb-3">
   <label for="email" class="form-label">Email</label>
   <input type="text" class="form-control"  name="email">
 </div>
 <div class="mb-3">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control"   name="password">
 </div>
 
 <div class="d-grid gap-2 col-6 mx-auto-end">
   <button class="btn btn-success " type="submit">Save</button>
 </form>
 </div>
 </div>


@endsection