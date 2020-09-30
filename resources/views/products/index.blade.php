@extends('layouts.master')

@section('content')
    
@foreach ($product as $products)
<div class="col-md-6">
 <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
   <div class="col p-4 d-flex flex-column position-static">
     <strong class="d-inline-block mb-2 text-success">
       @foreach ($products->categories as $category) 
        {{$category->name}}
       
        @endforeach
        </strong>
     <h6 class="mb-0">{{ $products->title }}</h6>
     <div class="mb-1 text-muted">{{ $products->created_at->format('h/m/Y') }}</div>
     <p class="mb-auto">{{ $products->subtitle }}</p>
     <strong class="mb-auto">{{ $products->getFrenchPrice() }}</strong>

     <a href="{{ route('products.show',$products->slug) }}" class="stretched-link btn btn-info">Voir l'article</a>
   </div>
   <div class="col-auto d-none d-lg-block">
     <img src="{{ $products->image }}" alt="">
   </div>
 </div>
</div>

    
@endforeach
{{ $product->appends(request()->input())->links()
}}
@endsection
