@extends('layouts.web')

@section('content')
<form class="card-form" method="POST" action="{{route('submitcheckout',['product_id' => $product->id])}}">
    @csrf
    <input type="hidden" name="payment_method" class="payment-method">
    <div class="container m-auto my-5">
        <div class="w-full px-16 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="py-16 px-4 md:px-6 2xl:px-0 flex justify-center items-center 2xl:mx-auto 2xl:container">
                <div class="flex flex-col justify-start items-start w-full space-y-9">
                    <div class="flex justify-start flex-col items-start space-y-2">
                        <a href="{{ route('index') }}" class="flex flex-row items-center text-gray-600 dark:text-white hover:text-gray-500 space-x-1">
                            <svg class="fill-stroke" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.91681 7H11.0835" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7L5.25014 9.33333" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7.00002L5.25014 4.66669" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm leading-none">Back</p>
                        </a>
                        <p class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800 dark:text-gray-50">Checkout</p>
                        <p class="text-base leading-normal sm:leading-4 text-gray-600 dark:text-white"><a href="{{ route('index') }}" class="text-gray-500">Home</a> > {{$product->title}}</p>
                    </div>

                    <div class="flex flex-col xl:flex-row justify-center xl:justify-between space-y-6 xl:space-y-0 xl:space-x-6 w-full">
                        <div class="xl:w-3/5 flex flex-col sm:flex-row xl:flex-col justify-center items-center py-7 sm:py-0 xl:py-10 px-10 xl:w-full  border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col justify-start items-start w-full space-y-4">
                                <p class="text-xl md:text-2xl leading-normal text-gray-800 dark:text-gray-50">{{$product->title}}</p>
                                <p class="text-base font-semibold leading-none text-gray-600 dark:text-white">${{number_format($product->price)}}</p>
                            </div>
                            <div class="mt-6 sm:mt-0 xl:my-10 xl:px-20 w-52 sm:w-96 xl:w-auto">
                                <img src="{{Storage::url('product-images/'.$product->logo)}}" alt="headphones" />
                            </div>
                        </div>

                        <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5  border border-gray-200">



                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                                <input type="text" id="name" name="name" placeholder="Name" required class="card_holder_name  w-full border rounded py-2 px-3">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Email" required class="w-full border rounded py-2 px-3">
                            </div>

                            <div class="mb-4">
                                <label for="card-element" class="block text-gray-700 font-bold mb-2">Credit Card:</label>
                                <div id="card-element" class="border rounded py-2 px-3"></div>
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert" class="text-red-500"></div>

                            <button class="mt-8 border border-transparent text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 rounded w-full">
                                <div>
                                    <p class="pay text-base leading-4">Pay ${{$product->price}}</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {
        style: style,
        hidePostalCode: true
    })
    card.mount('#card-element')
    let paymentMethod = null
    $('.card-form').on('submit', function(e) {
        $('p.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}", {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: $('.card_holder_name').val()
                    }
                }
            }
        ).then(function(result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('p.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-form').submit()
            }
        })
        return false
    })
</script>
@endsection