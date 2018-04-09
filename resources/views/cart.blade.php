@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/single-product/related-product-slider.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('css/cart/shopping-cart.css') }}" type="text/css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 class="text-center">Shopping Cart</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                  @if(Cart::count() > 0)
                    <thead>
                        <tr>
                            <th scope="col">{{ Cart::count() }} Item(s) in cart</th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th scope="col" class="text-right">Add To Wishlist </th>
                            <th scope="col" class="text-right">Delete </th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach(Cart::content() as $item)
    <tr>
        <td><a href="{{ route('shop.show', $item->model->slug) }}">
          @if($item->model->image)
          <img width="100px" src="{{ asset('storage/'.$item->model->image) }}" alt="img" class="img-thumbnail">
          @else
          <img width="100px" src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
          @endif
        </a></td>
        <td><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->name }}</a></td>
        <td>In stock</td>
        <td>
          <div>
            <select class="quantity" data-id="{{ $item->rowId }}">
                  @for ($i = 1; $i < 5 + 1 ; $i++)
                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
            </select>
          </div>
        </td>
        <td class="text-right">{{ presentPrice($item->subtotal) }}</td>
        <td class="text-right">
          <form action="{{ route('cart.wishlist', $item->rowId) }}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-sm btn-info">
             <i class="fa fa-heart"></i>
            </button>
          </form>
        </td>
        <td class="text-right">
          <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
            {{ csrf_field() }}
          <button class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i>
              {{ method_field('delete') }}
              </button>
            </form>
        </td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Sub-Total</td>
        <td class="text-right">{{ presentPrice(Cart::subtotal()) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Tax (21%)</td>
        <td class="text-right">{{ presentPrice(Cart::tax()) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Total</strong></td>
        <td class="text-right"><strong>{{ presentPrice(Cart::total()) }}</strong></td>
    </tr>
</tbody>
</table>
    @else
      <h4>No items in cart</h4>
      <h3><a class="btn btn-info" href="{{ route('shop.index') }}">continue shopping</a></h3>
    @endif
  </div><!-- end of div from table Shoppingcart -->
</div><!-- end of div col-12 -->
<div class="col mb-2">
        <div class="row">
            <div class="col-sm-12  col-md-6">
                <a href="{{ route('shop.index') }}" class="btn btn-block btn-light">Continue Shopping</a>
            </div>
            <div class="col-sm-12 col-md-6 text-right">
                <a href="{{ route('checkout.index') }}" class="btn btn-block btn-success text-uppercase">Next Step (Billing)</a>
            </div>
        </div>
    </div>
</div><!-- end of div row from Shoppingcart -->
<br><br><br><br>
<div class="row">
    <div class="col-12">
    <h2 class="text-center">Wishlist</h2>
    <div class="table-responsive">
        <table class="table table-striped">
  @if(Cart::instance('saveForLater')->count() > 0)
  <thead>
      <tr>
          <th scope="col">{{ Cart::instance('saveForLater')->count() }} Item(s) in wishlist</th>
          <th scope="col">Product</th>
          <th scope="col">Available</th>
          <th scope="col" class="text-right">Price</th>
          <th scope="col" class="text-right">Add To Cart </th>
          <th scope="col" class="text-right">Delete </th>
      </tr>
  </thead>
  <tbody>
    @foreach (Cart::instance('saveForLater')->content() as $item)
    <tr>
        <td>
          <a href="{{ route('shop.show', $item->model->slug) }}">
            @if($item->model->image)
            <img width="100px" src="{{ asset('storage/'.$item->model->image) }}" alt="img" class="img-thumbnail">
            @else
            <img width="100px" src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
            @endif
          </a>
        </td>
        <td><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->name }}</a></td>
        <td>In stock</td>
        <td class="text-right">{{ $item->model->presentPrice() }}</td>
        <td class="text-right">
          <form action="{{ route('wishlist.addtocart', $item->rowId) }}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-sm btn-succes">
             <i class="fas fa-shopping-cart"></i>
            </button>
          </form>
        </td>
        <td class="text-right">
          <form action="{{ route('wishlist.destroy', $item->rowId) }}" method="post">
            {{ csrf_field() }}
          <button class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i>
              {{ method_field('delete') }}
              </button>
            </form>
        </td>
    </tr>
    @endforeach

  @else
    <h3>No items in your wishlist</h3>

  @endif
</tbody>
</table>
</div>   <!-- end of div table responsive -->
</div>  <!-- end of col-md-12 wishlist -->
 </div> <!-- end of row wishlist -->
</div><!-- end of div container -->
<br><br><br><br><br><br>
  <!-- Below is "related" products -->
  <div class="container">
  <p> <h3 style="text-align:center;">You also might like</h3> </p>
    <div class="row mx-auto my-auto">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
          @foreach ($mightAlsoLike as $key=>$product)
             <div class="carousel-item {{ ($key == 0) ? "active" : "" }}">
               <a href="{{ route('shop.show', $product->slug) }}">
                 @if($product->image)
                 <img src="{{ asset('storage/'.$product->image) }}" alt="img" class="img-thumbnail">
                 @else
                 <img src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
                 @endif
               </a>
           </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
      </div>
    </div>  <!-- end of div last row from carrousel -->
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/single-product/related-product-slider.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> -->
<script>
   (function(){
     const classname = document.querySelectorAll('.quantity')

     Array.from(classname).forEach(function(element){
       element.addEventListener('change',function(){
         const id = element.getAttribute('data-id')
         axios.patch(`/cart/${id}`, {
           quantity : this.value
         })
         .then(function(response){
           window.location.href = '{{ route('cart.index') }}'
         })
         .catch(function(error){
           console.log(error);
         })
       })
     })
   })();
</script>
@endsection
