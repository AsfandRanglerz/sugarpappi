@extends('home.layout.app')
@section('title', 'Login')
@section('content')
    <style>
        svg.app {
            height: 40px;
        }

        .checkout .pay .btn {
            border: 2px solid black;
            border-radius: 10px;
        }

        /* remove increment buttons from the input */

        .number-input::-webkit-inner-spin-button,
        .number-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .number-input {
            -moz-appearance: textfield;
        }

        .select-input {
            display: flex;
            justify-content: space-between;
        }

        .select-input .select,
        .payment-cards .select,
        form.payment input {
            width: 30%;
            border-radius: 8px;
            padding: 7px 10px;
            border: 1px solid black;
        }

        .is-success {
            color: green;
        }

        .is-failure {
            color: red;
        }

        .select select {
            width: 100%;
            border: none;
        }

        .select select:focus {
            outline: none;
        }

        .select-input input {
            width: 66%;
        }

        .contact input {
            border: 1px solid black;
            border-radius: 8px;
            padding: 7px 10px;
        }

        .hide {
            display: none;
        }

        .active.deactive {
            border: 2px solid black;
            border-radius: 8px;
        }

        .deactive {
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .square-pay .square-checkbox,
        .earn-points {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .billing {
            position: sticky;
            top: 125px;
        }

        @media (max-width:991px) and (min-width:768px) {
            .billing {
                top: 10px;
            }
        }

        @media (max-width:767px) {
            .billing {
                position: static;
            }
        }

        .apple-pay-button {
            height: 48%;
            width: 100%;
            display: inline-block;
            -webkit-appearance: -apple-pay-button;
            -apple-pay-button-type: plain;
            -apple-pay-button-style: black;
        }
    </style>
    <section class="section">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-md-5 mb-3">
                <div class="container text-center my-lg-5 pt-lg-5 pb-lg-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Checkout</h1>
                </div>
            </div>
        </div>

        <!--Cart Section Start -->
        <div class="container-fluid cart wow fadeIn" data-wow-delay="0.1s">
            <div class="col-12 col-sm-11 col-md-12 col-lg-11 mx-auto mt-5">
                <div class="row justify-content-between align-items-start">
                    <div class="order-sm-1 order-2 col-md-7 col-lg-6 checkout mt-0">
                        <!-- Checkout Start -->

                        <!-- Express Check Out-->
                        <div class="pb-4 border-bottom">
                            <div class="d-flex flex-wrap justify-content-sm-between justify-content-center pay">
                                <h5 class="me-2 mb-3">EXPRESS CHECKOUT</h5>
                                <button class="btn w-50 btn-dark px-0 text-center"><svg data-v-7490c580=""
                                        xmlns="http://www.w3.org/2000/svg" width="119" height="22"
                                        viewBox="0 0 119 22" fill="none" svg-inline="" role="presentation"
                                        focusable="false" tabindex="-1" class="square-icon">
                                        <path data-v-7490c580=""
                                            d="M17.685 0H3.547A3.547 3.547 0 000 3.547v14.135a3.55 3.55 0 003.547 3.55h14.135a3.55 3.55 0 003.55-3.55V3.547A3.547 3.547 0 0017.682 0h.003zm-.313 16.252c0 .62-.503 1.12-1.12 1.12H4.982c-.616 0-1.12-.5-1.12-1.12V4.982c0-.62.5-1.12 1.12-1.12h11.27c.617 0 1.12.5 1.12 1.12v11.273-.003zm-4.503-2.754c.357 0 .643-.29.643-.646v-4.5a.644.644 0 00-.643-.647H8.363a.644.644 0 00-.643.646v4.5c0 .357.286.647.643.647h4.506zm13.992-.307h2.319c.117 1.313 1.006 2.336 2.801 2.336 1.602 0 2.588-.792 2.588-1.988 0-1.12-.772-1.623-2.164-1.95l-1.795-.387c-1.95-.424-3.419-1.681-3.419-3.728 0-2.26 2.01-3.807 4.617-3.807 2.764 0 4.542 1.447 4.694 3.594h-2.24c-.27-1.006-1.102-1.603-2.454-1.603-1.43 0-2.415.772-2.415 1.758 0 .985.851 1.584 2.319 1.912l1.778.386c1.95.424 3.284 1.602 3.284 3.67 0 2.628-1.971 4.193-4.79 4.193-3.167 0-4.927-1.72-5.12-4.386h-.003zm18.205 8.041v-3.845l.152-1.687h-.152c-.529 1.213-1.649 1.874-3.163 1.874-2.445 0-4.264-1.989-4.264-5.041 0-3.053 1.819-5.041 4.264-5.041 1.497 0 2.558.701 3.163 1.8h.152v-1.61h2.01v13.547h-2.162v.003zm.076-8.696c0-1.95-1.193-3.088-2.652-3.088s-2.652 1.137-2.652 3.088c0 1.95 1.193 3.088 2.652 3.088 1.46 0 2.652-1.138 2.652-3.088zm3.688 1.003V7.685h2.16v5.664c0 1.535.74 2.274 1.972 2.274 1.514 0 2.5-1.079 2.5-2.766V7.685h2.16v9.702h-2.008v-2.01h-.152c-.474 1.29-1.515 2.2-3.126 2.2-2.313 0-3.506-1.477-3.506-4.035v-.003zm10.108 1.137c0-1.819 1.27-2.88 3.524-3.012l2.673-.17v-.757c0-.91-.664-1.459-1.84-1.459-1.079 0-1.725.55-1.894 1.328H59.24c.228-1.971 1.856-3.109 4.055-3.109 2.483 0 3.998 1.062 3.998 3.109v6.784h-2.01v-1.802h-.151c-.456 1.194-1.4 1.989-3.223 1.989-1.821 0-2.974-1.176-2.974-2.898l.003-.003zm6.197-1.193v-.512l-2.179.152c-1.175.077-1.705.512-1.705 1.384 0 .74.606 1.269 1.46 1.269 1.535 0 2.424-.986 2.424-2.293zm3.769 3.904V7.685h2.009V9.54h.152c.283-1.269 1.251-1.856 2.69-1.856h.985v1.95h-1.23c-1.401 0-2.445.91-2.445 2.635v5.114h-2.161v.003zm15.72-4.454h-7.372c.114 1.781 1.366 2.784 2.749 2.784 1.175 0 1.912-.474 2.33-1.269h2.14c-.587 1.97-2.312 3.126-4.49 3.126-2.86 0-4.87-2.14-4.87-5.041 0-2.901 2.065-5.041 4.89-5.041 2.825 0 4.699 1.95 4.699 4.377 0 .474-.038.72-.076 1.061v.003zm-2.064-1.497c-.077-1.345-1.194-2.254-2.56-2.254-1.289 0-2.368.816-2.634 2.254h5.194zm7.395 5.95V4.127h4.889c2.822 0 4.547 1.439 4.547 4.035 0 2.597-1.726 4.036-4.547 4.036h-2.635v5.193h-2.254v-.003zm2.254-7.219h2.71c1.346 0 2.217-.681 2.217-2.009 0-1.327-.871-2.009-2.216-2.009h-2.71v4.018zm7.293 4.51c0-1.82 1.269-2.881 3.523-3.013l2.673-.17v-.757c0-.91-.664-1.459-1.839-1.459-1.079 0-1.649.55-1.819 1.328h-2.161c.228-1.971 1.781-3.109 3.98-3.109 2.482 0 3.997 1.062 3.997 3.109v6.784h-2.009v-1.802h-.152c-.456 1.194-1.404 1.989-3.222 1.989-1.819 0-2.974-1.176-2.974-2.898l.003-.003zm6.196-1.194v-.512l-2.178.152c-1.176.077-1.705.512-1.705 1.384 0 .74.605 1.269 1.459 1.269 1.535 0 2.424-.986 2.424-2.293zm3.143 7.465v-1.912h1.629c.854 0 1.328-.266 1.629-1.006l.19-.491-4.091-9.852h2.407l2.102 5.474.494 1.591h.152l.474-1.59 1.988-5.475h2.313l-4.111 10.685c-.74 1.913-1.705 2.576-3.43 2.576h-1.746z"
                                            fill="var(--icon-fill, white)"></path>
                                    </svg></button>
                                {{-- <button class="btn text-dark w-50  px-0 text-center">
                                <span><svg data-v-1d24ab5c="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 436 212"
                                        height="26" svg-inline="" role="presentation" focusable="false" tabindex="-1"
                                        class="google-icon">
                                        <path data-v-1d24ab5c="" fill-rule="evenodd"
                                            d="M206.2 174.33h-16.1V49h42.7c2.54-.05 5.08.15 7.59.59a38.884 38.884 0 0114.1 5.53c2.13 1.38 4.13 2.96 5.96 4.73a34.64 34.64 0 014.96 5.52c1.45 2.02 2.69 4.18 3.68 6.45.99 2.28 1.74 4.65 2.23 7.09.49 2.43.72 4.91.68 7.39.05 2.49-.16 4.99-.65 7.44a34.76 34.76 0 01-2.21 7.12 34.98 34.98 0 01-8.69 12.04c-7.47 7.12-16.68 10.68-27.65 10.67h-26.6v50.76zm0-66.15h27c1.48.04 2.95-.07 4.41-.33 1.45-.26 2.87-.67 4.24-1.23a21.47 21.47 0 003.9-2.08c1.22-.83 2.35-1.78 3.38-2.84a21.302 21.302 0 006.47-15.31 21.302 21.302 0 00-6.47-15.32 20.651 20.651 0 00-3.36-2.9c-1.22-.85-2.52-1.57-3.89-2.14-1.37-.57-2.8-.99-4.25-1.27-1.46-.27-2.95-.38-4.43-.34h-27v43.76zM309.1 85.78c11.9 0 21.29 3.18 28.18 9.54 6.89 6.36 10.33 15.08 10.32 26.16v52.85h-15.4v-11.9h-.7c-6.67 9.8-15.53 14.7-26.6 14.7-9.45 0-17.35-2.8-23.71-8.4-1.52-1.28-2.9-2.73-4.1-4.31-1.2-1.59-2.22-3.3-3.04-5.11a26.697 26.697 0 01-2.4-11.58c0-8.87 3.35-15.93 10.06-21.17 6.71-5.24 15.66-7.87 26.86-7.88 9.56 0 17.43 1.75 23.62 5.25v-3.68a18.288 18.288 0 00-1.72-7.87c-.57-1.23-1.28-2.39-2.11-3.47-.83-1.07-1.78-2.05-2.82-2.91-1.05-.95-2.19-1.8-3.4-2.54s-2.49-1.36-3.82-1.86c-1.32-.5-2.69-.88-4.09-1.12-1.4-.25-2.81-.37-4.23-.35-8.99 0-16.11 3.79-21.35 11.38l-14.18-8.93c7.8-11.2 19.34-16.8 34.63-16.8zm-20.48 65.33c.23 1 .58 1.96 1.05 2.87.46.91 1.03 1.76 1.69 2.53.67.78 1.42 1.47 2.25 2.07.88.69 1.82 1.31 2.81 1.84.99.54 2.02.98 3.08 1.34 1.07.36 2.16.62 3.27.8 1.11.17 2.23.24 3.35.22 1.68 0 3.35-.17 5-.5 1.64-.33 3.25-.82 4.8-1.46 1.55-.65 3.03-1.44 4.43-2.37 1.39-.94 2.69-2 3.88-3.19 5.33-5.02 8-10.91 8-17.67-5.02-4-12.02-6-21-6-6.54 0-11.99 1.58-16.36 4.73-4.41 3.2-6.6 7.09-6.6 11.76-.01 1.02.11 2.04.35 3.03z">
                                        </path>
                                        <path data-v-1d24ab5c=""
                                            d="M436 88.58l-53.76 123.55h-16.62l19.95-43.23-35.35-80.32h17.5l25.55 61.6h.35l24.85-61.6H436z">
                                        </path>
                                        <path data-v-1d24ab5c="" fill="#4285f4"
                                            d="M141.14 112.64c0-1.23-.02-2.45-.07-3.68-.06-1.22-.13-2.45-.24-3.67-.1-1.22-.23-2.44-.38-3.65-.16-1.22-.34-2.43-.55-3.64H72v27.73h38.89a33.8 33.8 0 01-1.85 6.46c-.83 2.08-1.87 4.08-3.1 5.95a32.623 32.623 0 01-4.24 5.21 33.148 33.148 0 01-5.19 4.26v18h23.21c13.59-12.53 21.42-31.06 21.42-52.97z">
                                        </path>
                                        <path data-v-1d24ab5c="" fill="#34a853"
                                            d="M72 183c19.43 0 35.79-6.38 47.72-17.38l-23.21-18C90.05 152 81.73 154.5 72 154.5c-18.78 0-34.72-12.66-40.42-29.72H7.67v18.55a71.816 71.816 0 0011.26 16.32 71.79 71.79 0 0015.28 12.63 71.752 71.752 0 0018.15 7.99c6.39 1.81 13 2.73 19.64 2.73z">
                                        </path>
                                        <path data-v-1d24ab5c="" fill="#fbbc04"
                                            d="M31.58 124.78a43.05 43.05 0 01-1.69-6.8 42.96 42.96 0 010-13.96c.38-2.31.94-4.58 1.69-6.8V78.67H7.67c-2.51 5-4.43 10.27-5.72 15.72A72.032 72.032 0 000 111c0 5.59.66 11.17 1.95 16.61a71.978 71.978 0 005.72 15.72l23.91-18.55z">
                                        </path>
                                        <path data-v-1d24ab5c="" fill="#ea4335"
                                            d="M72 67.5c2.54-.04 5.07.16 7.57.61 2.49.45 4.94 1.15 7.3 2.07 2.37.92 4.63 2.07 6.77 3.44 2.14 1.36 4.14 2.93 5.98 4.68l20.55-20.55a69.53 69.53 0 00-10.46-8.09 68.763 68.763 0 00-11.81-5.95 68.779 68.779 0 00-12.72-3.6A69.34 69.34 0 0072 39c-6.64 0-13.25.92-19.64 2.73-6.39 1.81-12.5 4.5-18.15 7.99a71.79 71.79 0 00-15.28 12.63A71.816 71.816 0 007.67 78.67l23.91 18.55C37.28 80.16 53.22 67.5 72 67.5z">
                                        </path>
                                    </svg></span>
                            </button> --}}
                            </div>
                        </div>
                        <!-- Express CheckOut End -->
                        <!-- Contact Start -->
                        {{-- <div class=" contact mt-4 pb-4 border-bottom">
                        <p class="">Contact</p>
                        <div class="select-input">
                            <!-- <span class="select"> -->
                            <!-- <select name="" id="" disabled>
                                                                                                                                                                                                                                                    <option value="" selected>USA</option>
                                                                                                                                                                                                                                                </select> -->
                            <input type="text" class="select" value="United States" readonly>
                            <!-- </span> -->
                            <input type="number" class="number-input" placeholder="Phone Number">
                        </div>
                        <input type="text" class="mt-2 w-100" type="email" placeholder="Email Address for Reciept">
                        <div class="mt-2 row">
                            <div class="col-md-6">
                                <input type="text" class="w-100" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="w-100 mt-md-0 mt-2" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="">
                            <p class="small mt-2 mb-0 px-2">By providing your phone number/email, you agree to receive
                                order updates via text or email from Square and our other partners on our behalf.
                                <span class="d-inline-block">
                                    <span
                                        class="text-danger d-flex justify-content-center align-items-center arrow">Learn
                                        More<span class="h3 text-danger ri-arrow-drop-down-line m-auto"></span></span>
                                </span>
                            </p>
                            <p class="small hide">Standard text messaging rates may apply. Reply STOP to opt-out of
                                receiving future text messages related to your order. You can unsubscribe from any email
                                sent to you.</p>
                        </div>
                    </div> --}}
                        <!-- Contact End -->
                        <!-- Payment Start-->
                        <div class="mt-4">
                            <p class="mb-0">Payment</p>
                            <p class="small">All transactions are secure and encrypted</p>
                            <!-- Credit Card Section -->
                            {{-- <div class="mt-4 p-3  active deactive credit-Card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Credit Card</h6>
                                <span class="h2 m-0 ri-bank-card-2-fill"></span>
                            </div> --}}

                            {{-- Square Pyament Gate way --}}
                            <form class="mt-2 payment" action="" method="POST">
                                @csrf
                                @foreach ($branchess as $index => $branch)
                                    @if ($branch->status == 1)
                                        @if ($branch->id == 7 || $branch->id == 6)
                                            @if (Auth::guard('user')->check())
                                                <form id="payment-form-{{ $branch->id }}" action="{{ route('orders') }}"
                                                    method="POST">
                                                    @csrf
                                                    {{-- <div id="apple-pay-button-{{ $branch->id }}" class="apple-pay-button">
                                                    </div> --}}
                                                    <div id="card-container-{{ $branch->id }}"></div>
                                                    <div id="payment-status-container-{{ $branch->id }}"></div>
                                                    <div id="error-container" class="text-danger d-none">Payment Failed!You
                                                        Enter
                                                        Wrong Card Number</div>
                                                    <button id="card-button-{{ $branch->id }}"
                                                        class="mt-3 w-100 rounded-3 btn py-2 btn-danger creditCard-btn placeOrderBtn"
                                                        type="button">Place Order</button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="mt-3 w-100 rounded-3 btn py-2 btn-danger" type="button">Get
                                                    Login First</a>
                                            @endif
                                            {{-- Apple Pay code --}}

                                            {{-- <script>
                                                // Replace the following placeholders with actual values from your backend
                                                const appId =
                                                    '{{ $branch->id == 7 ? 'sandbox-sq0idb-n489qdNvgOK09cci071CTQ' : 'sandbox-sq0idb-4yO68m0zPZ6TemxS4LyW4Q' }}';
                                                const locationId = '{{ $branch->id == 7 ? 'L5E1ETVGXNTVF' : 'L5E1ETVGXNTVF' }}';

                                                // Function to build payment request
                                                async function buildPaymentRequest(payments) {
                                                    return payments.paymentRequest({
                                                        countryCode: 'US',
                                                        currencyCode: 'USD',
                                                        total: {
                                                            amount: '0.5', // Replace this with the total amount of the transaction in the smallest currency unit
                                                            label: 'Total',
                                                        },
                                                    });
                                                }

                                                // Function to initialize Apple Pay
                                                async function initializeApplePay(payments) {
                                                    const paymentRequest = await buildPaymentRequest(payments);
                                                    return payments.applePay(paymentRequest);
                                                }

                                                document.addEventListener('DOMContentLoaded', async function() {
                                                    if (!window.Square) {
                                                        throw new Error('Square.js failed to load properly');
                                                    }
                                                    const payments = window.Square.payments(appId, locationId);
                                                    let applePay;

                                                    try {
                                                        applePay = await initializeApplePay(payments);
                                                    } catch (e) {
                                                        console.error('Initialization failed', e);
                                                        return;
                                                    }

                                                    // Function to create payment
                                                    async function createPayment(token) {
                                                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                                        const body = JSON.stringify({
                                                            _token: csrfToken,
                                                            locationId: locationId,
                                                            sourceId: token,
                                                            idempotencyKey: generateIdempotencyKey()
                                                        });
                                                        try {
                                                            const response = await fetch('{{ route('orders') }}', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': csrfToken
                                                                },
                                                                body: body
                                                            });

                                                            if (!response.ok) {
                                                                throw new Error('Payment failed. Please try again.');
                                                            } else {
                                                                const responseData = await response.json();
                                                                displayPaymentResults('success');
                                                                window.location.href = "{{ route('my-order') }}";
                                                                return responseData;
                                                            }
                                                        } catch (error) {
                                                            console.error('Error:', error);
                                                            throw new Error('Error processing payment');
                                                        }
                                                    }

                                                    // Event handler for Apple Pay button click
                                                    const applePayButton = document.getElementById('apple-pay-button-{{ $branch->id }}');
                                                    applePayButton.addEventListener('click', async function(event) {
                                                        event.preventDefault();
                                                        applePayButton.disabled = true;
                                                        try {
                                                            const token = await tokenizeApplePay(applePay);
                                                            await createPayment(token);
                                                            displayPaymentResults('success');
                                                            console.debug('Payment Success');
                                                        } catch (error) {
                                                            displayPaymentResults('failure');
                                                            console.error('Payment Error:', error.message);
                                                        } finally {
                                                            applePayButton.disabled = false;
                                                        }
                                                    });

                                                    // Function to generate idempotency key
                                                    function generateIdempotencyKey() {
                                                        return Math.random().toString(36).substr(2, 9);
                                                    }

                                                    // Function to display payment results
                                                    function displayPaymentResults(status) {
                                                        const statusContainer = document.getElementById(
                                                            'payment-status-container-{{ $branch->id }}');
                                                        statusContainer.classList.remove('is-success', 'is-failure');
                                                        statusContainer.classList.add(`is-${status}`);
                                                        statusContainer.style.visibility = 'visible';
                                                        statusContainer.textContent = status === 'failure' ?
                                                            'Payment failed. Please try again.' :
                                                            'Payment succeeded!';
                                                    }

                                                    // Function to tokenize Apple Pay
                                                    async function tokenizeApplePay(applePay) {
                                                        const tokenResult = await applePay.tokenize();
                                                        if (tokenResult.status === 'OK') {
                                                            return tokenResult.token;
                                                        } else {
                                                            let errorMessage = `Tokenization failed - status: ${tokenResult.status}`;
                                                            if (tokenResult.errors) {
                                                                errorMessage += ` and errors: ${JSON.stringify(tokenResult.errors)}`;
                                                            }
                                                            throw new Error(errorMessage);
                                                        }
                                                    }
                                                });
                                            </script> --}}



                                            {{-- Apple Pay code End --}}

                                            {{-- Square Payment code  --}}
                                            <script>
                                                const appId{{ $branch->id }} =
                                                    '{{ $branch->id == 7 ? 'sq0idp-_sWTWbaEUsOdKOR8IqP2Dw' : 'sq0idp-psADGzIxmbakdNIJTYEAJA' }}';
                                                const locationId{{ $branch->id }} = '{{ $branch->id == 7 ? 'LEQD2YKEFHA6F' : 'LA1P71RPSV13J' }}';

                                                async function initializeCard{{ $branch->id }}(payments) {
                                                    const card = await payments.card();
                                                    await card.attach('#card-container-{{ $branch->id }}');
                                                    return card;
                                                }
                                                document.addEventListener('DOMContentLoaded', async function() {
                                                    if (!window.Square) {
                                                        throw new Error('Square.js failed to load properly');
                                                    }
                                                    const payments{{ $branch->id }} = window.Square.payments(appId{{ $branch->id }},
                                                        locationId{{ $branch->id }});
                                                    let card{{ $branch->id }};
                                                    try {
                                                        card{{ $branch->id }} = await initializeCard{{ $branch->id }}(
                                                            payments{{ $branch->id }});
                                                    } catch (e) {
                                                        console.error('Initializing Card failed', e);
                                                        return;
                                                    }
                                                    async function createPayment{{ $branch->id }}(token) {
                                                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                                        const body = JSON.stringify({
                                                            _token: csrfToken,
                                                            locationId: locationId{{ $branch->id }},
                                                            sourceId: token,
                                                            idempotencyKey: generateIdempotencyKey()
                                                        });
                                                        try {
                                                            const response = await fetch('{{ route('orders') }}', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': csrfToken
                                                                },
                                                                body: body
                                                            });
                                                            if (!response.ok) {
                                                                // throw new Error('Network response was not ok');
                                                                const errorContainer = document.getElementById('error-container');
                                                                errorContainer.classList.remove('d-none')
                                                                errorContainer.textContent = responseData.error;
                                                            } else {
                                                                const responseData = await response.json();
                                                                displayPaymentResults{{ $branch->id }}(status)
                                                                window.location.href = "{{ route('my-order') }}";
                                                                return responseData;
                                                            }
                                                        } catch (error) {
                                                            console.error('Error:', error);
                                                            throw new Error('Error processing payment');
                                                            alert('Error processing payment: ' + error.message);
                                                            throw error;
                                                        }
                                                    }

                                                    function generateIdempotencyKey() {
                                                        return Math.random().toString(36).substr(2, 9);
                                                    }
                                                    async function tokenize{{ $branch->id }}(paymentMethod) {
                                                        const tokenResult = await paymentMethod.tokenize();
                                                        if (tokenResult.status === 'OK') {
                                                            return tokenResult.token;
                                                        } else {
                                                            let errorMessage = `Tokenization failed-status: ${tokenResult.status}`;
                                                            if (tokenResult.errors) {
                                                                errorMessage += ` and errors: ${JSON.stringify(tokenResult.errors)}`;
                                                            }
                                                            throw new Error(errorMessage);
                                                        }
                                                    }

                                                    function displayPaymentResults{{ $branch->id }}(status) {
                                                        const statusContainer = document.getElementById(
                                                            'payment-status-container-{{ $branch->id }}');
                                                        statusContainer.classList.remove('is-success', 'is-failure');
                                                        statusContainer.classList.add(`is-${status}`);
                                                        statusContainer.style.visibility = 'visible';
                                                        statusContainer.textContent = status === 'failure' ?
                                                            'Payment failed. Please try again.' :
                                                            'Payment succeeded!';
                                                    }
                                                    async function handlePaymentMethodSubmission{{ $branch->id }}(event, paymentMethod) {
                                                        event.preventDefault();
                                                        const cardButton = document.getElementById('card-button-{{ $branch->id }}');
                                                        cardButton.disabled = true;
                                                        try {
                                                            const token = await tokenize{{ $branch->id }}(paymentMethod);
                                                            const paymentResults = await createPayment{{ $branch->id }}(token);
                                                            displayPaymentResults{{ $branch->id }}('success');
                                                            console.debug('Payment Success', paymentResults);
                                                        } catch (error) {
                                                            displayPaymentResults{{ $branch->id }}('failure');
                                                            console.error('Payment Error:', error.message);
                                                        } finally {
                                                            cardButton.disabled = false;
                                                        }
                                                    }
                                                    const cardButton{{ $branch->id }} = document.getElementById(
                                                        'card-button-{{ $branch->id }}');
                                                    cardButton{{ $branch->id }}.addEventListener('click', async function(event) {
                                                        await handlePaymentMethodSubmission{{ $branch->id }}(event,
                                                            card{{ $branch->id }});
                                                    });

                                                });
                                            </script>
                                            {{-- Square Payment code End --}}
                                        @elseif($branch->id == 8 || $branch->id == 14)
                                            @if (Auth::guard('user')->check())
                                                <form id="payment-form-{{ $branch->id }}" action="{{ route('orders') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div id="card-container-{{ $branch->id }}"></div>
                                                    <div id="payment-status-container-{{ $branch->id }}"></div>
                                                    <div id="error-container" class="text-danger d-none">Payment Failed!You
                                                        Enter
                                                        Wrong Card Number</div>
                                                    <button id="card-button-{{ $branch->id }}"
                                                        class="mt-3 w-100 rounded-3 btn py-2 btn-danger creditCard-btn placeOrderBtn"
                                                        type="button">Place Order</button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="mt-3 w-100 rounded-3 btn py-2 btn-danger" type="button">Get
                                                    Login First</a>
                                            @endif
                                            <script>
                                                const appId{{ $branch->id }} =
                                                    '{{ $branch->id == 8 ? 'sq0idp-7xh47gO_8lOHXPdOaE-4_Q' : 'sq0idp-xpGxmrAY40sWTa9UckF3tg' }}';
                                                const locationId{{ $branch->id }} =
                                                    '{{ $branch->id == 8 ? 'LYWE975DYHCKC' : 'LQACR4JDEK4KZ' }}';
                                                async function initializeCard{{ $branch->id }}(payments) {
                                                    const card = await payments.card();
                                                    await card.attach('#card-container-{{ $branch->id }}');
                                                    return card;
                                                }
                                                document.addEventListener('DOMContentLoaded', async function() {
                                                    if (!window.Square) {
                                                        throw new Error('Square.js failed to load properly');
                                                    }
                                                    const payments{{ $branch->id }} = window.Square.payments(appId{{ $branch->id }},
                                                        locationId{{ $branch->id }});
                                                    let card{{ $branch->id }};
                                                    try {
                                                        card{{ $branch->id }} = await initializeCard{{ $branch->id }}(
                                                            payments{{ $branch->id }});
                                                    } catch (e) {
                                                        console.error('Initializing Card failed', e);
                                                        return;
                                                    }
                                                    async function createPayment{{ $branch->id }}(token) {
                                                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                                        const body = JSON.stringify({
                                                            _token: csrfToken,
                                                            locationId: locationId{{ $branch->id }},
                                                            sourceId: token,
                                                            idempotencyKey: generateIdempotencyKey()
                                                        });
                                                        try {
                                                            const response = await fetch('{{ route('orders') }}', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': csrfToken
                                                                },
                                                                body: body
                                                            });
                                                            if (!response.ok) {
                                                                // throw new Error('Network response was not ok');
                                                                const errorContainer = document.getElementById('error-container');
                                                                errorContainer.classList.remove('d-none')
                                                                errorContainer.textContent = responseData.error;
                                                            } else {
                                                                const responseData = await response.json();
                                                                displayPaymentResults{{ $branch->id }}(status)
                                                                window.location.href = "{{ route('my-order') }}";
                                                                return responseData;
                                                            }
                                                        } catch (error) {
                                                            console.error('Error:', error);
                                                            throw new Error('Error processing payment');
                                                            alert('Error processing payment: ' + error.message);
                                                            throw error;
                                                        }
                                                    }

                                                    function generateIdempotencyKey() {
                                                        return Math.random().toString(36).substr(2, 9);
                                                    }
                                                    async function tokenize{{ $branch->id }}(paymentMethod) {
                                                        const tokenResult = await paymentMethod.tokenize();
                                                        if (tokenResult.status === 'OK') {
                                                            return tokenResult.token;
                                                        } else {
                                                            let errorMessage = `Tokenization failed-status: ${tokenResult.status}`;
                                                            if (tokenResult.errors) {
                                                                errorMessage += ` and errors: ${JSON.stringify(tokenResult.errors)}`;
                                                            }
                                                            throw new Error(errorMessage);
                                                        }
                                                    }

                                                    function displayPaymentResults{{ $branch->id }}(status) {
                                                        const statusContainer = document.getElementById(
                                                            'payment-status-container-{{ $branch->id }}');
                                                        statusContainer.classList.remove('is-success', 'is-failure');
                                                        statusContainer.classList.add(`is-${status}`);
                                                        statusContainer.style.visibility = 'visible';
                                                        statusContainer.textContent = status === 'failure' ?
                                                            'Payment failed. Please try again.' :
                                                            'Payment succeeded!';
                                                    }
                                                    async function handlePaymentMethodSubmission{{ $branch->id }}(event, paymentMethod) {
                                                        event.preventDefault();
                                                        const cardButton = document.getElementById('card-button-{{ $branch->id }}');
                                                        cardButton.disabled = true;
                                                        try {
                                                            const token = await tokenize{{ $branch->id }}(paymentMethod);
                                                            const paymentResults = await createPayment{{ $branch->id }}(token);
                                                            displayPaymentResults{{ $branch->id }}('success');
                                                            console.debug('Payment Success', paymentResults);
                                                        } catch (error) {
                                                            displayPaymentResults{{ $branch->id }}('failure');
                                                            console.error('Payment Error:', error.message);
                                                        } finally {
                                                            cardButton.disabled = false;
                                                        }
                                                    }
                                                    const cardButton{{ $branch->id }} = document.getElementById(
                                                        'card-button-{{ $branch->id }}');
                                                    cardButton{{ $branch->id }}.addEventListener('click', async function(event) {
                                                        await handlePaymentMethodSubmission{{ $branch->id }}(event,
                                                            card{{ $branch->id }});
                                                    });

                                                });
                                            </script>
                                        @endif
                                    @endif
                                @endforeach
                                {{-- <button class="btn btn-primary placeOrderBtn">Order</button> --}}
                                {{-- Square Pyament Gate way End --}}
                                {{-- <input type="hidden" id="nonce" name="nonce">
                                <div class="mt-3 row">
                                    <div class="col-md-6">
                                        <label class="form-label">CARD NUMBER<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control w-100" name="card_number"
                                            placeholder="4321 xxxx xxxx xxxx">
                                    </div>
                                    <div class="col-md-6 mt-md-0 mt-3">
                                        <label class="form-label">NAME ON CARD<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control w-100" placeholder="Jhon Doe"
                                            name="card_name">
                                    </div>
                                </div>
                                <div class="mt-3 row justify-content-between">
                                    <div class="col-md-6">
                                        <label class="form-label">Date of Expiry<span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex justify-content-between">
                                            <input type="number" class="form-control w-50 me-1" placeholder="MM"
                                                name="month">
                                            <input type="number" class="form-control w-50 ms-1" placeholder="YY"
                                                name="year">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <label class="form-label">CVC<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control w-100" placeholder="ex. 311" name="cvc">
                                    </div>
                                </div>
                        </div> --}}
                                <!-- Credit Section -->
                                <!-- Cash Pay Start -->
                                {{-- <div class="mt-4 p-3  deactive cash-Pay">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Cash Pay</h6>
                                <span class="h2 m-0 p-0"><svg data-v-6959bfec="" data-v-7c3b755e="" width="34"
                                        height="24" viewBox="0 0 34 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        svg-inline="" role="presentation" focusable="false" tabindex="-1"
                                        class="pay-with-cash-payment-option__icon">
                                        <path data-v-6959bfec="" data-v-7c3b755e=""
                                            d="M0 4a4 4 0 014-4h26a4 4 0 014 4v16a4 4 0 01-4 4H4a4 4 0 01-4-4V4z"
                                            fill="#00D632"></path>
                                        <path data-v-6959bfec="" data-v-7c3b755e="" fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M17.485 8.176c1.14 0 2.232.462 2.946 1.095.18.16.45.16.62-.012l.85-.862a.443.443 0 00-.021-.645 6.716 6.716 0 00-2.277-1.28l.266-1.27a.445.445 0 00-.435-.535h-1.642a.445.445 0 00-.435.352l-.24 1.128c-2.182.109-4.031 1.198-4.031 3.432 0 1.933 1.53 2.762 3.145 3.336 1.53.573 2.337.786 2.337 1.594 0 .828-.807 1.317-1.997 1.317-1.085 0-2.222-.358-3.104-1.228a.443.443 0 00-.623 0l-.913.9a.448.448 0 00.003.639c.712.69 1.613 1.19 2.641 1.47l-.25 1.176a.445.445 0 00.432.538l1.644.012a.444.444 0 00.438-.353l.238-1.13c2.612-.162 4.211-1.582 4.211-3.66 0-1.912-1.593-2.72-3.527-3.379-1.105-.404-2.061-.68-2.061-1.508 0-.808.892-1.127 1.785-1.127z"
                                            fill="#fff"></path>
                                    </svg></span>
                            </div>
                        </div> --}}
                                <!-- Cash Pay End -->
                                <!-- After Pay Start -->
                                {{-- <div class="mt-4 p-3  deactive after-Pay">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0">After Pay</h6>
                                <span class="h2 m-0 p-0"><svg data-v-0a67701c="" data-v-7c3b755e="" data-name="Layer 1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 24" width="38" height="24"
                                        svg-inline="" role="presentation" focusable="false" tabindex="-1"
                                        class="afterpay-payment-option__icon">
                                        <path data-v-0a67701c="" data-v-7c3b755e=""
                                            d="M35 0H3a3 3 0 00-3 3v18a3 3 0 003 3h32a3 3 0 003-3V3a3 3 0 00-3-3z"
                                            fill="#b2fce4"></path>
                                        <path data-v-0a67701c="" data-v-7c3b755e=""
                                            d="M36.12 10l-1.06-.61L34 8.75a1.07 1.07 0 00-1.6.93v.13a.23.23 0 00.1.19l.5.28a.2.2 0 00.28-.08.19.19 0 000-.1v-.32a.21.21 0 01.2-.22h.12l1 .57 1 .56a.22.22 0 01.07.3l-.07.07-1 .56-1 .57a.21.21 0 01-.29-.07.24.24 0 010-.12v-.16a1.07 1.07 0 00-1.6-.93l-1.08.62-1.06.61a1.08 1.08 0 00-.4 1.46 1 1 0 00.4.4l1.06.61 1.08.61a1.07 1.07 0 001.6-.93v-.13a.23.23 0 00-.1-.19l-.5-.29a.2.2 0 00-.28.08.23.23 0 000 .11v.32a.21.21 0 01-.2.22.27.27 0 01-.12 0l-1-.57-1-.56A.22.22 0 0130 13l.07-.07 1-.56 1-.57a.21.21 0 01.29.07.24.24 0 010 .12v.16a1.07 1.07 0 001.6.93l1.08-.62 1.06-.61a1.06 1.06 0 00.34-1.47 1 1 0 00-.32-.38zM29.14 10.18l-2.49 5.14h-1l.93-1.92-1.46-3.22h1.06l.94 2.15 1-2.15zM4.25 12a1 1 0 10-1 1.05 1 1 0 001-1V12m0 1.83v-.48a1.49 1.49 0 01-1.16.54 1.79 1.79 0 01-1.75-1.83V12a1.82 1.82 0 011.75-1.89 1.47 1.47 0 011.14.53v-.46h.89v3.65zM9.52 13c-.32 0-.4-.12-.4-.42V11h.57v-.79h-.57v-.92H8.2v.89H7v-.37c0-.3.12-.42.44-.42h.2v-.71h-.43c-.76 0-1.12.25-1.12 1v.49h-.51V11h.51v2.86H7V11h1.2v1.79c0 .75.28 1.07 1 1.07h.5V13zM12.82 11.67a.87.87 0 00-.91-.75.89.89 0 00-.92.75zm-1.82.57a.91.91 0 00.94.85 1 1 0 00.86-.47h.94a1.79 1.79 0 01-1.82 1.27A1.8 1.8 0 0110 12.22V12a1.89 1.89 0 113.78 0 .89.89 0 010 .23zM19.66 12a1 1 0 100 .05V12m-2.89 3.32v-5.14h.89v.47a1.49 1.49 0 011.16-.54 1.79 1.79 0 011.76 1.82V12a1.82 1.82 0 01-1.75 1.89 1.44 1.44 0 01-1.11-.49v1.92zM23.82 12a1 1 0 10-1.05 1.05h.05a1 1 0 001-1V12m0 1.83v-.48a1.46 1.46 0 01-1.15.54 1.79 1.79 0 01-1.76-1.82V12a1.82 1.82 0 011.75-1.89 1.45 1.45 0 011.13.53v-.46h.9v3.65zM15.15 10.54a.91.91 0 01.79-.43.88.88 0 01.39.08v.94a1.15 1.15 0 00-.65-.17.64.64 0 00-.5.71v2.16h-.93v-3.65h.9z">
                                        </path>
                                    </svg></span>
                            </div>
                            <p class="small">4 interest-free installments of $40.55</p>
                        </div> --}}
                                <!-- After Pay End -->
                                <!-- Create Account Section -->
                                {{-- <div class="mt-4 square-pay pb-4 border-bottom square">
                            <div class="d-flex px-3 justify-content-between align-content-center">
                                <h6 class="mt-2">Create Account</h6>
                                <img src="square Pay.png" style="object-fit: contain;" alt="">
                            </div>
                            <div class="mt-4 square-checkbox p-3 rounded rounded-3">
                                <div class="form-check  ">
                                    <input class="form-check-input" type="checkbox" name="exampleRadios"
                                        id="exampleRadios2" value="option2">
                                    <label class="form-check-label small" for="exampleRadios2">
                                        Save your payment info for faster reordering at A-Z Nutrition & Smoothies and
                                        secure checkout with Square.
                                    </label>
                                </div>
                            </div>
                            <span class="small d-inline-block px-2">By selecting Square Pay, you agree to the <span
                                    class="text-danger fw-bold">Square Buyer Account Terms</span> and <span
                                    class="text-danger fw-bold">Privacy Policy.</span> You may
                                receive promotional emails from Square.</span>
                        </div> --}}
                                <!-- Create Account End -->
                                {{-- <div class="mt-4">
                            <div class="stay-touch">
                                <h6>STAY IN TOUCH</h6>
                                <div class="mt-4 earn-points rounded rounded-3 p-3">
                                    <div class="d-flex">
                                        <span class="ri-star-smile-fill"></span>
                                        <div class="ms-2">
                                            <p class="small m-0"> Earn Points with your order by joining our Loyalty
                                                program.</p>
                                            <p class="small m-0 text-danger">See Awards</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="earn-points p-3 mt-1 rounded rounded-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label small" for="flexSwitchCheckDefault">Sign
                                            Up</label>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <small class="small m-0 d-inline-block px-2">By signing up, I agree to receive
                                        automated informational and marketing texts, including Loyalty messages,
                                        coupons, and discounts. Joining this program is not a condition of purchase. To
                                        unsubscribe at any time, reply “END”, std rates apply. The card you use for this
                                        or future transactions will be automatically linked with your account to surface
                                        offers or rewards.</small>
                                </div>
                            </div>
                        </div> --}}
                        </div>
                        <!-- Payment End -->
                        <!-- Check Out End -->
                    </div>
                    <!-- Part 2 -->
                    @php
                        use App\Models\Topping;
                        use App\Models\Branch;
                    @endphp
                    <div class="order-sm-2 order-1 col-md-5 billing">
                        <div class="row justify-content-end mt-0">
                            <div class="col-xl-11 mt-0">
                                <!-- Alert And Location Start -->
                                <div class="border-bottom pb-3 mt-0">
                                    <h5 class="mb-3">PICKUP AT</h5>
                                    <div class>
                                        <span class="pb-2">
                                            <span class="pb-2">
                                                @foreach ($branchess as $index => $branch)
                                                    @if ($branch->status == 1)
                                                        <span class="ri-map-pin-line"></span>
                                                        Pickup:{{ $branch->location }}
                                                    @endif
                                                @endforeach
                                            </span>
                                            <br>
                                            @if ($dateTime = session('time'))
                                                <span class="ri-time-line"></span>
                                                {{ \Carbon\Carbon::parse($dateTime['date'])->format('d M, Y') }} at
                                                {{ $dateTime['time'] }}
                                            @else
                                                @foreach ($timeSlots as $timeSlot)
                                                    <span class><span class="ri-time-line"> </span>Today Pickup:
                                                        {{ $timeSlot->start_pickup_time }}</span>
                                                @break
                                            @endforeach
                                        @endif
                                </div>
                                @if (Auth::guard('user')->check())
                                    <h6 class="mt-3">Vehicle Info (Optional)</h6>
                                    <div class="row vehicle-info">
                                        <div class="col-6 px-2">
                                            <input type="text" id="vehicleColor" name="vehicle_color"
                                                class="form-control" placeholder="Vehicle Color"
                                                style="border-radius: 6px">
                                        </div>
                                        <div class="col-6 px-2">
                                            <input type="text" id="vehicleNumber" name="vehicle_no"
                                                class="form-control" placeholder="Vehicle No #"
                                                style="border-radius: 6px">
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $userId = Auth::guard('user')->id();
                                    $reward = App\Models\Reward::where('user_id', $userId)->first();
                                    $remaining = null;
                                    if ($reward) {
                                        $remaining = $reward->rewards - $reward->redeemed;
                                    }
                                @endphp
                                @if ($remaining)
                                    <h6 class="mt-3">Earned Reward: <span
                                            id="redeemDollar">{{ $remaining }}</span> $
                                        (Optional)</h6>
                                    <input type="number" id="addAmount" name="redeemed" class="form-control"
                                        placeholder="Amount i.e... 50, 60 etc" style="border-radius: 6px">
                                    <b class="small">(Note: Redeemed your dollars from your earned reward.)</b>
                                @endif
                            </div>
                            <!-- Location -->
                            <!-- Blling Start -->
                            @php
                                $cartItems = session('cart', []);
                                // Calculate the total based on the prices of all items
                                $totalQuantity = count($cartItems);
                                $subtotal = 0;

                                foreach ($cartItems as $item) {
                                    // @dd($item['branch_id.tax']);
                                    $subtotal += floatval($item['price'] * $item['quantity']);
                                    // $subtotal += floatval(trim($item['price'])) * floatval($item['quantity']);

                                    // Check if 'topping_prices' index exists in the $item array

                                    if (isset($item['toppings_by_category'])) {
                                        foreach ($item['toppings_by_category'] as $category => $toppingIds) {
                                            foreach ($toppingIds as $toppingId) {
                                                // Assuming you have a Toppings model with a 'price' column
                                                $topping = Topping::find($toppingId);
                                                if ($topping) {
                                                    $subtotal += $topping->price;
                                                }
                                            }
                                        }
                                    }
                                }
                                // $tip_amount = session('tip_amount', []);
                                $tip_amount = session('tip_amount', 0);
                                $tax = 0; // Initialize tax variable
                                foreach ($branchess as $index => $branch) {
                                    if ($branch->status == 1) {
                                        $tax = $branch->tax; // Assign branch tax to $tax variable
                                    }
                                }

                                // Assuming a fixed tax amount
                                $tip = $tip_amount;
                                // @dd($tip);
                                // $tip = is_array($tip_amount) ? 0 : $tip_amount;
                                // $orderTotal = $subtotal + $tax + $tip;
                                $orderTotal = $subtotal + $tax + $tip;
                                session(['orderTotal' => $orderTotal]);
                            @endphp

                            <div class="mt-sm-4 pb-sm-4 mt-3 pb-3">

                                <!-- Subtotal -->
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Sub Total</p>
                                    <p class="sub-total">${{ number_format($subtotal, 2) }}</p>
                                </div>
                                <!-- Estimated taxes -->
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Estimated taxes (New York)</p>
                                    <p class="tax-value">${{ number_format($tax, 2) }}</p>
                                </div>
                                <!-- Tip -->
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Tip</p>
                                    <p class="tip-value">${{ number_format($tip, 2) }}</p>
                                </div>
                                <!-- Estimated order total -->
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Estimated order total</p>
                                    <p class="total-value">${{ number_format($orderTotal, 2) }}</p>
                                </div>
                            </div>
                            <p>Additional taxes and fees will be calculated at checkout</p>

                            {{-- End --}}
                            {{--
                            <button class="mt-3 w-100 rounded-3 btn py-2 btn-danger creditCard-btn"
                                id="placeOrderBtn">Place Order</button> --}}
                            </form>
                            <button
                                class="mt-3 w-100  justify-content-center align-items-center gap-1 rounded-3 btn py-2 btn-dark cashPay-btn"
                                hidden><span class="h2 m-0 p-0"><svg data-v-6959bfec="" data-v-7c3b755e=""
                                        width="34" height="24" viewBox="0 0 34 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" svg-inline="" role="presentation"
                                        focusable="false" tabindex="-1" class="pay-with-cash-payment-option__icon">
                                        <path data-v-6959bfec="" data-v-7c3b755e=""
                                            d="M0 4a4 4 0 014-4h26a4 4 0 014 4v16a4 4 0 01-4 4H4a4 4 0 01-4-4V4z"
                                            fill="#00D632"></path>
                                        <path data-v-6959bfec="" data-v-7c3b755e="" fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M17.485 8.176c1.14 0 2.232.462 2.946 1.095.18.16.45.16.62-.012l.85-.862a.443.443 0 00-.021-.645 6.716 6.716 0 00-2.277-1.28l.266-1.27a.445.445 0 00-.435-.535h-1.642a.445.445 0 00-.435.352l-.24 1.128c-2.182.109-4.031 1.198-4.031 3.432 0 1.933 1.53 2.762 3.145 3.336 1.53.573 2.337.786 2.337 1.594 0 .828-.807 1.317-1.997 1.317-1.085 0-2.222-.358-3.104-1.228a.443.443 0 00-.623 0l-.913.9a.448.448 0 00.003.639c.712.69 1.613 1.19 2.641 1.47l-.25 1.176a.445.445 0 00.432.538l1.644.012a.444.444 0 00.438-.353l.238-1.13c2.612-.162 4.211-1.582 4.211-3.66 0-1.912-1.593-2.72-3.527-3.379-1.105-.404-2.061-.68-2.061-1.508 0-.808.892-1.127 1.785-1.127z"
                                            fill="#fff"></path>
                                    </svg></span>
                                Cash App Pay</button>
                            <button class="mt-3 w-100 rounded-3 btn text-dark py-1 afterPay-btn"
                                style="background-color:rgb(175, 252, 240);" hidden>Continue with <span><svg
                                        class="app" data-v-8f3aa612="" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="300 225 1250 400" svg-inline="" aria-hidden="true" tabindex="-1"
                                        role="presentation" focusable="false">
                                        <path data-v-8f3aa612=""
                                            d="M1492 353.5l-34.6-19.8-35.1-20.1c-23.2-13.3-52.2 3.4-52.2 30.2v4.5c0 2.5 1.3 4.8 3.5 6l16.3 9.3c4.5 2.6 10.1-.7 10.1-5.9V347c0-5.3 5.7-8.6 10.3-6l32 18.4 31.9 18.3c4.6 2.6 4.6 9.3 0 11.9l-31.9 18.3-32 18.4c-4.6 2.6-10.3-.7-10.3-6V415c0-26.8-29-43.6-52.2-30.2l-35.1 20.1-34.6 19.8c-23.3 13.4-23.3 47.1 0 60.5l34.6 19.8 35.1 20.1c23.2 13.3 52.2-3.4 52.2-30.2v-4.5c0-2.5-1.3-4.8-3.5-6l-16.3-9.3c-4.5-2.6-10.1.7-10.1 5.9v10.7c0 5.3-5.7 8.6-10.3 6l-32-18.4-31.9-18.3c-4.6-2.6-4.6-9.3 0-11.9l31.9-18.3 32-18.4c4.6-2.6 10.3.7 10.3 6v5.3c0 26.8 29 43.6 52.2 30.2l35.1-20.1L1492 414c23.3-13.5 23.3-47.1 0-60.5zM1265 360.1l-81 167.3h-33.6l30.3-62.5-47.7-104.8h34.5l30.6 70.2 33.4-70.2h33.5zM455.1 419.5c0-20-14.5-34-32.3-34s-32.3 14.3-32.3 34c0 19.5 14.5 34 32.3 34s32.3-14 32.3-34m.3 59.4v-15.4c-8.8 10.7-21.9 17.3-37.5 17.3-32.6 0-57.3-26.1-57.3-61.3 0-34.9 25.7-61.5 58-61.5 15.2 0 28 6.7 36.8 17.1v-15h29.2v118.8h-29.2zM626.6 452.5c-10.2 0-13.1-3.8-13.1-13.8V386h18.8v-25.9h-18.8v-29h-29.9v29H545v-11.8c0-10 3.8-13.8 14.3-13.8h6.6v-23h-14.4c-24.7 0-36.4 8.1-36.4 32.8v15.9h-16.6V386h16.6v92.9H545V386h38.6v58.2c0 24.2 9.3 34.7 33.5 34.7h15.4v-26.4h-5.9zM734 408.8c-2.1-15.4-14.7-24.7-29.5-24.7-14.7 0-26.9 9-29.9 24.7H734zm-59.7 18.5c2.1 17.6 14.7 27.6 30.7 27.6 12.6 0 22.3-5.9 28-15.4h30.7c-7.1 25.2-29.7 41.3-59.4 41.3-35.9 0-61.1-25.2-61.1-61.1 0-35.9 26.6-61.8 61.8-61.8 35.4 0 61.1 26.1 61.1 61.8 0 2.6-.2 5.2-.7 7.6h-91.1zM956.5 419.5c0-19.2-14.5-34-32.3-34-17.8 0-32.3 14.3-32.3 34 0 19.5 14.5 34 32.3 34 17.8 0 32.3-14.7 32.3-34m-94.1 107.9V360.1h29.2v15.4c8.8-10.9 21.9-17.6 37.5-17.6 32.1 0 57.3 26.4 57.3 61.3s-25.7 61.5-58 61.5c-15 0-27.3-5.9-35.9-15.9v62.5h-30.1zM1091.7 419.5c0-20-14.5-34-32.3-34-17.8 0-32.3 14.3-32.3 34 0 19.5 14.5 34 32.3 34 17.8 0 32.3-14 32.3-34m.3 59.4v-15.4c-8.8 10.7-21.9 17.3-37.5 17.3-32.6 0-57.3-26.1-57.3-61.3 0-34.9 25.7-61.5 58-61.5 15.2 0 28 6.7 36.8 17.1v-15h29.2v118.8H1092zM809.7 371.7s7.4-13.8 25.7-13.8c7.8 0 12.8 2.7 12.8 2.7v30.3s-11-6.8-21.1-5.4c-10.1 1.4-16.5 10.6-16.5 23v70.3h-30.2V360.1h29.2v11.6z">
                                        </path>
                                    </svg></span></button>
                        </div>
                        <!-- Billing ENd -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@section('js')
@if (\Illuminate\Support\Facades\Session::has('message'))
    <script>
        toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
    </script>
@endif

<script>
    $(document).ready(function() {
        // Get the initial value of redeemDollar
        var redeemDollarValue = parseInt($("#redeemDollar").text());

        // Listen for changes in the input field
        $("#addAmount").on("input", function() {
            var currentValue = parseInt($(this).val());

            // If the current value is less than redeemDollarValue, set it to redeemDollarValue
            if (currentValue < 1 || isNaN(currentValue)) {
                $(this).val('');
            } else if (currentValue > redeemDollarValue) {
                $(this).val(redeemDollarValue);
            }
        });

        // Prevent paste action
        $("#addAmount").on("paste", function(e) {
            e.preventDefault();
        });

        $('.placeOrderBtn').click(function() {
            var vehicleColor = $('input[name="vehicle_color"]')
                .val(); // Get the value of vehicle color input field
            var vehicleNumber = $('input[name="vehicle_no"]')
                .val(); // Get the value of vehicle number input field
            var redeemed = $('input[name="redeemed"]').val(); // Get the value of redeemed input field


            // Use AJAX to send the data to the server
            $.ajax({
                type: 'POST',
                url: '{{ route('store.vehicle.info') }}', // Replace 'store.vehicle.info' with your actual route
                data: {
                    '_token': '{{ csrf_token() }}',
                    'vehicle_color': vehicleColor,
                    'vehicle_number': vehicleNumber,
                    'redeemed': redeemed
                },
                success: function(data) {
                    console.log('Vehicle info stored successfully!', data);
                    // You can perform any other actions here after successful storage
                },
                error: function(error) {
                    console.error('Error storing vehicle info:', error);
                }
            });
        });
    });
</script>

{{-- <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script> --}}
<script type="text/javascript" src="https://web.squarecdn.com/v1/square.js"></script>

@endsection
