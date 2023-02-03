@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Create Product___</h1>
<br>
<br>
<div class="row">
    <div class="col-md-6">
       <form   method="post" action="{{ route('productCreateAll')}}">
          @csrf
          <div class="mb-5">
          <select  class="form-control" name="categoryId">
            <option selected>choose the category</option>
         @foreach($categories as $category)
            
         <option  value="{{$category->id}}">{{$category->categoryTitle}}</option>
       
         @endforeach
          </select>
          </div>
          <div class="mb-3">
            <label for="productTitle" class="form-label">Product name</label>
            <input type="text" class="form-control" name="productTitle">
                    </div>
            <div class="mb-3">
                <label for="productAmout" class="form-label">Amout</label>
                <input type="text" class="form-control" name="productAmout">
            </div>
            <div class="mb-3">
            <label for="productCount" class="form-label">Count</label>
            <input type="text" class="form-control"  name="productCount">
            </div>         
 <div class="d-grid gap-2 col-6 mx-auto-end">
   <button class="btn btn-success " type="submit">Save</button>
 </form>
 </div>
 </div>
@endsection