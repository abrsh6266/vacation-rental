@extends('layouts.app')

@section('content')
    <div class="hero-wrap js-fullheight"
        style="margin-top:-25px; background-image: url({{ asset('assets/images/room-1.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <h2 class="subheading">Pay with payPal</h2>
                    {{-- <p><a href="{{ route('home') }}" class="btn btn-primary">Go Home</a> </p> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script
            src="https://www.paypal.com/sdk/js?client-id=AbWlfnPxojPIeHnX0v29Ju5Yi_EcoFIYWoszI3ytGewsYib9-9kGIXI95Dbkpmm0bFpeG64D01SdOdE5&currency=USD">
        </script>
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{ Session::get('price') }} // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {

                        window.location.href = 'http://localhost:8000/hotels/success';
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </div>
@endsection
