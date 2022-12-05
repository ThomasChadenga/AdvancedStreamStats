@extends('layout')

@section('content')
    <div class="container unique">
        <div class="row justify-content-center unique">
            <div class="col-md-8">

                @csrf
                <style>
                    .button {
                        cursor: pointer;
                        font-weight: 500;
                        left: 3px;
                        line-height: inherit;
                        position: relative;
                        text-decoration: none;
                        text-align: center;
                        border-style: solid;
                        border-width: 1px;
                        border-radius: 3px;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        display: inline-block;
                    }

                    .button--small {
                        padding: 10px 20px;
                        font-size: 0.875rem;
                    }

                    .button--green {
                        outline: none;
                        background-color: #64d18a;
                        border-color: #64d18a;
                        color: white;
                        transition: all 200ms ease;
                    }

                    .button--green:hover {
                        background-color: #8bdda8;
                        color: white;
                    }
                </style>
                <script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.js"></script>

                <div style="margin-bottom:-20px; margin-top:20px">
                    You are about to pay for a <strong>{{ $subscription }}</strong> subscription.
                </div>
                <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" id=payment_method_nonce" name="payment_method_nonce" />
                    <div id="dropin-container"></div>
                    <button id="submit-button" class="button button--small button--green">Subscribe</button>
                </form>
                <script>
                    var button = document.querySelector('#submit-button');
                    var form = document.querySelector('#checkout-form');

                    braintree.dropin.create({
                        authorization: 'sandbox_5rsnksbh_cg2stbhtww9cpmt2',
                        selector: '#dropin-container'
                    }, function (err, instance) {
                        button.addEventListener('click', function () {
                            instance.requestPaymentMethod(function (err, payload) {
                                // Submit payload.nonce to your server
                                document.querySelector("#payment_method_nonce").value = payload.nonce;
                                form.submit();
                            });
                        })
                    });
                </script>
            </div>
        </div>
    </div>
