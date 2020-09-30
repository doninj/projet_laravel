@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">


@section('content')

<div class="col-md-12">
    <h1>page de paiement</h1>


    <div class="row">
        <div class="col-md-6">

            <form  action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="my-4">
                @csrf
                <div id="card-element">
                    <!--Stripe.js injects the Card Element-->
                </div>
                <button class='btn btn-success mt-4' id="submit">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="button-text">Paiement {{ getPrice(Cart::total()).' '.'€' }}</span>
                </button>
                <p id="card-error" class="alert-warning" role="alert"></p>
                <p class="result-message hidden">
                    Payment succeeded, see the result in your
                    <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                </p>
            </form>

        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
var stripe = Stripe('pk_test_51HW0KxJCQEN2WDSOe0QhgzmH5qShEH4gUIHYRfXtdX3LUDCcEoW7b8kfQLOUBpqt8z5mpRWsKlTz9pwYqxhDu4YJ00pvimhYaE');
var elements = stripe.elements();

var style = {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };
  var card = elements.create("card", { style: style });
  card.mount("#card-element");

  card.on('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

var submitButton = document.getElementById('submit');

submitButton.addEventListener('click', function(ev) {
  ev.preventDefault();
  submitButton.disabled=true;
  stripe.confirmCardPayment("{{$clientSecret}}", {
    payment_method: {
      card: card
      
    }
  }).then(function(result) {
    if (result.error) {
        submitButton.disabled=false;
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
       var paymentIntent=result.paymentIntent;
       var token= document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var form= document.getElementById('payment-form');
        var url=form.action;
        var redirect="/merci";

//requete AJAX
fetch(
url,
{
    headers:{
    "Content-Type": "application/json",
    "Accept": "application/json, text-plain, */*",
    "X-Requested-With":'XMLHttpRequest',
    "X-CSRF-TOKEN": token
    },
    method:'post',
    body: JSON.stringify({
        paymentIntent:paymentIntent
    })
    }

).then((data)=>{
    console.log(data)
    window.location.href= redirect;
}).catch((error) => {
    console.log(error)
    
}) 
      }
    }
  });
});
</script>
@endsection
