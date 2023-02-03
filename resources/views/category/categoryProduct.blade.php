@extends('users.app')
@section('content')
<br>

<h1 class="text-center">___Products of {{$category->categoryTitle}}___</h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content  me-auto"> 
                    <button type="button" class="btn btn-success ">{{ Auth::User()->firstName}}</button>
                    <a href="{{ route('logout')}}"><button type="button" class="btn btn-outline-danger">Log out</button></a>
                    <a class="btn btn-info"><i class="bi bi-{{$category->categoryChosen}}-circle"></i></a>
                    <button type="button" class="btn btn-light">{{$category->categorySumm}} $</button>
                </div>
              
            <a href="{{ route('usersPage')}}"><button type="button" class="btn btn-warning ">Users</button></a>
            <a href="{{ route('categoryPage')}}"><button type="button" class="btn btn-warning ">Category</button></a>
            <a href="{{ route('productSold')}}"><button type="button" class="btn btn-warning ">Placing an order</button></a>
           <a href="{{ route('productCreate',$category->id)}}"><button type="button" class="btn btn-success">create</button></a>
        </div>
<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th class="col-md-1">T/R</th>
            <th class="col-md-3">Products</th>
            <th class="col-md-3">Amout</th>
            <th class="col-md-1">Count</th>
            <th class="col-md-1">Chosen</th>
            <th class="col-md-1">Basket</th>
            <th class="col-md-1">Abort</th>
            <th class="col-md-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{($loop->index+1) }}</td>

            <td>{{ $product->productTitle}} </td>
            <td>{{ $product->productAmout}} $</td>
            <td>{{ $product->productCount}} </td>
                    <td> 
                       <a class="btn btn-info"><i class="bi bi-{{$product->productChosen}}-circle"></i></a>
                    </td>
                    <td>
                        <a href="{{ route('productBasket',$product->id)}}" class="btn btn-outline-success"><i class="bi bi-patch-check"></i></a> 
                    </td>
                    <td>
                        <a href="{{ route('productAbort',$product->id)}}" class="btn btn-outline-danger"><i class="bi bi-patch-minus"></i></a>
                    </td>
            <td>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                           <a href="{{ route('productUpdate',$product->id)}}"><button type="button" class="btn btn-primary">Update</button></a>
                           <a href="{{ route('productDelete',$product->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- {{ $products ->links()}} --}}
@endsection