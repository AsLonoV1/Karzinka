@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Update Category___</h1>
<br>
<br>
<div class="row">
    <div class="col-md-6">
       <form   method="post" action="{{ route('categoryUpdate',$category->id)}}">
          @csrf
          <br>
          <br>
          <div class="mb-4">
            <label for="categoryTitle" class="form-label">Title name</label>
            <input type="text" class="form-control" name="categoryTitle"  value="{{$category->categoryTitle}}">  
                    </div>
                    <div class="form-check mb-4"  >
                      <label class="form-check-label" >
                        Active
                      </label>
                      <input class="form-check-input" type="checkbox" name="categoryStatus" value="1" >
                    </div>
           <br>
           <br>
           <br> 
 <div class="d-grid gap-2 col-6 mx-auto-end">
   <button class="btn btn-success " type="submit">Save</button>
 </form>
 </div>
 </div>


@endsection