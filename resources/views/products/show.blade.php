@extends('layouts.master')

@section('content')
    
<div class="col-md-12">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">
          @foreach ($product->categories as $category)
          {{ $category->name }}{{ $loop->last ? '': ', ' }}
              
          @endforeach
        </strong>
        <h6 class="mb-0">{{ $product->title }}</h6>
        <div class="mb-1 text-muted">{{ $product->created_at->format('h/m/Y') }}</div>
        <p class="mb-auto">{{ $product->description }}</p>
        <strong class="mb-auto">{{ $product->getFrenchPrice() }}</strong>
        <form action="{{ route('cart.store') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value='{{ $product->id }}'>
           

            <button type="submit" class="btn btn-dark">Ajouter au panier</button>
        </form>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="{{ $product->image }}" alt="">
      </div>
    </div>
  </div>    
@endsection