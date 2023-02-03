@extends('users.app')
@section('content')
<br>
<h1 class="text-center">___Update Product___</h1>
<br>
<br>
<div class="row">
    <div class="col-md-6">
       <form   method="post" action="{{ route('productUpdateAll',$product->id)}}">
          @csrf
          <div class="mb-3">
            <label for="productTitle" class="form-label">Product name</label>
            <input type="text" class="form-control" name="productTitle" value="{{$product->productTitle}}" >
                    </div>
            <div class="mb-3">
                <label for="productAmout" class="form-label">Amout</label>
                <input type="text" class="form-control" name="productAmout" value="{{$product->productAmout}}">
            </div>
            <div class="mb-3">
            <label for="productCount" class="form-label">Count</label>
            <input type="text" class="form-control"  name="productCount" value="{{$product->productCount}}">
            </div>         
 <div class="d-grid gap-2 col-6 mx-auto-end">
   <button class="btn btn-success " type="submit">Save</button>
 </form>
 </div>
 </div>
@endsection