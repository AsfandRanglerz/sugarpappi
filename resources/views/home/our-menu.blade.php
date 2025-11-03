@extends('home.layout.app')
@section('title', 'Login')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
    <style>
        .change-btn {
            width: 90px;
            display: inline-block;
            background: #b35615;
            padding: 4px 8px;
        }

        .change-blink {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            display: inline-block;
            background: green;
            top: -6px;
            right: -6px;
            border: 1px solid #FFF;
        }

        .pika-button:hover {
            color: white;
            background-color: #9e0e1b;
        }

        .time-modal-button {
            background-color: #f1f1f1;

        }

        .calender {
            position: absolute;
            top: 50%;
            right: 1%;
            transform: translate(-50%, -50%);
        }

        .time-radios {
            border-bottom: 1px solid black;
        }

        .time-radios:last-of-type {
            border-bottom: none;
        }
    </style>
    <section class="section">
        <div class="container-xxl py-5 bg-dark hero-header mb-sm-5">
            <div class="container text-center my-lg-5 my-0 pt-lg-5 pb-lg-4 py-3">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Our Menu</h1>
                @foreach ($branches as $branch)
                    @if ($branch->status == 1)
                        <h6 class="text-white">Pickup From: <span class="location-set">{{ $branch->location }}</span> <a
                                href="#" data-bs-toggle="modal" @endif
                    @endforeach data-bs-target="#time-Modal"
                    class="mt-sm-0 mt-2 ms-3 py-2 text-white position-relative change-btn">Change <span
                        class="position-absolute blink change-blink"></span></a></h6>
                    @if ($dateTime = session('time'))
                        <div class="text-white">
                            <span class="ri-time-line"></span>
                            {{ \Carbon\Carbon::parse($dateTime['date'])->format('d M, Y') }} at
                            {{ $dateTime['time'] }}
                        </div>
                    @else
                        @foreach ($timeSlots as $timeSlot)
                            <h6 class="text-white">Today at {{ $timeSlot->start_pickup_time }}</h6>
                        @break
                    @endforeach
                @endif
        </div>
    </div>
    <div class="container-xxl bg-white p-0">
        <!-- Time Modal -->
        <div class="container-fluid time-modal">
            <div class="modal fade" id="time-Modal" tabindex="-1" aria-labelledby="time-Modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header p-3">
                            <button data-bs-toggle="modal" data-bs-target="#locationModal"
                                class="text-start locattion-button-show-btn rounded rounded-3 time-modal-button btn px-3 py-2 col-12">
                                <div class="d-flex justify-content-between col-12">
                                    <div>
                                        <h6 class="my-2">
                                            @foreach ($branches as $index => $branch)
                                                @if ($branch->status == 1)
                                                    <span class="fa fa-solid fa-map-pin me-2"></span>
                                                    Pickup: <span class="location-set">{{ $branch->location }}</span>
                                                @endif
                                            @endforeach

                                        </h6>
                                    </div>
                                    <h6 class="my-2"><span class="fa fa-solid fa-location-arrow"></span></h6>
                                </div>
                            </button>
                        </div>
                        <div class="modal-body pt-4 pb-2 m-0 scrollable">
                            <div class="form-group">
                                <label for="datepicker">
                                    <h6>Select pickup time</h6>
                                </label>
                                <div class="position-relative">
                                    @if ($dateTime = session('time'))
                                        <input class="form-control rounded py-2 rounded-3 time_input" id="datepicker"
                                            type="text" name="date_input" value="{{ $dateTime['date'] }}">
                                        <span class="fa fa-calendar calender"></span>
                                    @else
                                        <input class="form-control rounded py-2 rounded-3 time_input" id="datepicker"
                                            type="text" name="date_input">
                                        <span class="fa fa-calendar calender"></span>
                                    @endif
                                </div>
                            </div>
                            {{--  @for ($i = 0; $i < count($timeSlots); $i++) @php
                                $startTime=\Carbon\Carbon::parse($timeSlots[$i]->start_pickup_time);
                                $endTime = \Carbon\Carbon::parse($timeSlots[$i]->end_pickup_time);
                                @endphp

                                @while ($startTime->lt($endTime))
                                <div class="d-flex time-radios align-items-center py-3">
                                    <input class="form-check-input me-2" type="radio" id="time-radio-2-{{ $i + 1 }}"
                                        value="{{ $startTime->addMinutes(15)->format('h:i A') }}" name="time-radio">
                                    <label for="time-radio-2-{{ $i + 1 }}" class="ms-1">
                                        <h6 class="m-0">{{ $startTime->format('h:i A') }}</h6>
                                    </label>
                                </div>
                                @php
                                $i++;
                                @endphp
                                @endwhile
                                @endfor  --}}

                            @for ($i = 0; $i < count($timeSlots); $i++)
                                @php
                                    $startTime = \Carbon\Carbon::parse($timeSlots[$i]['start_pickup_time']); // Parse start time
                                    $endTime = \Carbon\Carbon::parse($timeSlots[$i]['end_pickup_time']); // Parse end time
                                    if ($endTime < $startTime) {
                                        $endTime->addDays(1);
                                    }
                                @endphp
                                @while ($startTime <= $endTime)
                                    @php
                                        $a = $i++;
                                    @endphp
                                    {{-- Use comparison operator instead of assignment --}}
                                    <div class="d-flex time-radios align-items-center py-3">
                                        <input class="form-check-input me-2" type="radio"
                                            id="time-radio-2-{{ $a }}"
                                            value="{{ $startTime->format('h:i A') }}" name="time-radio">
                                        <label for="time-radio-2-{{ $a }}" class="ms-1">
                                            <h6 class="m-0">{{ $startTime->format('h:i A') }}</h6>
                                        </label>
                                    </div>

                                    @php
                                        $startTime->addMinutes(15); // Add 15 minutes to start time
                                    @endphp
                                @endwhile
                            @endfor

                        </div>
                        <div class="modal-footer position-relative px-2">
                            <button type="button"
                                style="font-size: 24px;position: absolute;left: 0;width: 30px;height: 30px;display: flex;justify-content: center;align-items: center"
                                class="btn time-modal-close ri-close-circle-line btn-danger px-2 ms-3 py-0"
                                data-bs-dismiss="modal"></button>
                            <div class="text-center mx-auto">
                                <button class="btn btn-danger px-sm-5 px-4 updateTimeBtnn">Update Time</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Time Modal Close -->
        <!-- Location Modal Start -->
        <div class="container-fluid cart wow fadeIn" data-wow-delay="0.1s">
            <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="z-index: 5555">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header p-2">
                            <ul class="nav nav-pills w-100" id="pills-tab" role="tablist">
                                <li class="nav-item w-100" role="presentation">
                                    <button class="nav-link rounded-0 w-100 active" id="pills-pickup-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-pickup" type="button"
                                        role="tab" aria-controls="pills-pickup" aria-selected="true">Pickup</button>
                                </li>
                                {{-- <li class="nav-item w-50" role="presentation">
                                    <button class="nav-link rounded-0 w-100" id="pills-delivery-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-delivery" type="button" role="tab"
                                        aria-controls="pills-delivery" aria-selected="false">Delivery</button>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="modal-body py-0 my-0 scrollable">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pickup" role="tabpanel"
                                    aria-labelledby="pills-pickup-tab">
                                    <div class="py-4 border-bottom">
                                        <h5 class="mb-0">Select Location</h5>
                                    </div>
                                    <!-- Location's Parent  Start-->
                                    <div class="">
                                        <!-- Location-2 -->

                                        @php

                                            $locationImages = [
                                                asset('public/img/location-img1.png'),
                                                asset('public/img/location-img2.png'),
                                                asset('public/img/location-img3.png'),
                                                asset('public/img/location-img4.png'),
                                                // Add more images as needed
                                            ];
                                        @endphp

                                        {{-- @dd($branches); --}}
                                        {{-- @foreach ($branches as $index => $branch)
                                        <div class="d-flex justify-content-between location-card border-bottom py-3">
                                            <div class="d-flex align-items-start">
                                                <input class="form-check-input me-2 location-radio" type="radio"
                                                    id="location-{{ $branch->id }}" name="choosen_location"
                                                    data-branch-id="{{ $branch->id }}">
                                                <label for="location-{{ $branch->id }}"
                                                    class="ms-1 location-branch-parent">
                                                    <h6 class="small fw-bold m-0">{{ $branch->name }}</h6>
                                                    <p class="small fw-bold m-0 branch-location location-branch">
                                                        {{ $branch->location }}</p>
                                                    <b class="text-success m-0">Item Available</b>
                                                </label>
                                            </div>
                                            <a class="location-description" data-bs-toggle="modal"
                                                data-bs-target="#locationDescription" style="cursor: pointer">
                                                <!-- Use the loop index to select the corresponding image -->
                                                <img class="location-img" src="{{ $locationImages[$index] }}"
                                                    alt="location-img{{ $index + 1 }}">
                                                <p class="small m-0">+100 miles</p>
                                                <p class="text-danger">Store Info</p>
                                            </a>
                                        </div>
                                        @endforeach --}}
                                        @foreach ($branches as $index => $branch)
                                            <div
                                                class="d-flex justify-content-between location-card border-bottom py-3">
                                                <div class="d-flex align-items-start">
                                                    <input class="form-check-input me-2 location-radio" type="radio"
                                                        id="location-{{ $branch->id }}" name="choosen_location"
                                                        data-branch-id="{{ $branch->id }}"
                                                        {{ $branch->status == 1 ? 'checked' : '' }}>
                                                    <label for="location-{{ $branch->id }}"
                                                        class="ms-1 location-branch-parent">
                                                        <h6 class="small fw-bold m-0">{{ $branch->name }}</h6>
                                                        <p class="small fw-bold m-0 branch-location">
                                                            {{ $branch->location }}</p>
                                                        <b class="text-success m-0">Item Available</b>
                                                    </label>
                                                </div>
                                                @if (isset($locationImages[$index]))
                                                    <a class="location-description" data-bs-toggle="modal"
                                                        data-bs-target="#locationDescription" style="cursor: pointer">
                                                        <!-- Use the loop index to select the corresponding image -->
                                                        <img class="location-img" src="{{ $locationImages[$index] }}"
                                                            alt="location-img{{ $index + 1 }}">
                                                        <p class="small m-0">+100 miles</p>
                                                        <p class="text-danger">Store Info</p>
                                                    </a>
                                                @else
                                                    <p class="text-danger">No Image Available</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Location's Parent End -->
                                </div>
                                <div class="tab-pane fade" id="pills-delivery" role="tabpanel"
                                    aria-labelledby="pills-delivery-tab">
                                    <form>
                                        <div class="row g-3 my-5">
                                            <div class="col-12 mt-0">
                                                <h5>Enter Delivery Address</h5>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control"
                                                        placeholder="Delivery Address">
                                                    <label>Delivery Address</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control"
                                                        placeholder="Apt, Floor, Suite, etc. (Optional)">
                                                    <label>Apt, Floor, Suite, etc. (Optional)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer position-relative px-2">
                            <button type="button"
                                style="font-size: 24px;position: absolute;left: 0;width: 30px;height: 30px;display: flex;justify-content: center;align-items: center"
                                class="btn location-modal-close ri-close-circle-line btn-danger px-2 ms-3 py-0"
                                data-bs-dismiss="modal"></button>
                            <div class="text-center mx-auto">
                                <button class="btn btn-danger px-sm-5 px-4 updateLocationBtn location-update-btn"
                                    data-bs-dismiss="modal">Update
                                    Location</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Location Modal End -->
        <!-- Location Description Modal Start -->
        <div class="container-fluid cart wow fadeIn" data-wow-delay="0.1s">
            <div class="modal fade" id="locationDescription" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog border-0 modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0">
                            <iframe class="w-100" height="300"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24143.571414161433!2d-73.88015888916016!3d40.85110000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f4ab1d311eaf%3A0x3ffe46c5ab0f82ad!2sStarbucks!5e0!3m2!1sen!2sus!4v1761317780273!5m2!1sen!2sus"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="p-3">
                                <h6 class="mb-3 locationHeading">Sugar Pappi</h6>
                                <p class="m-0 address1"></p>
                                <ul>
                                    @if ($userTimeSlots)
                                        <li>Pickup:
                                            {{ \Carbon\Carbon::parse($userTimeSlots->date)->format('d M, Y') }} at
                                            {{ $userTimeSlots->time }}</li>
                                    @else
                                        @foreach ($timeSlots as $timeSlot)
                                            <li>
                                                Today Pickup:
                                                {{ $timeSlot->start_pickup_time }}
                                            </li>
                                        @break
                                    @endforeach
                                @endif
                                <li>
                                    Estimated prep time: Available Immediately
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="font-size:30px"
                            class="btn location-description-btn ri-close-circle-line btn-danger px-2 py-0 me-auto"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Description Modal End -->

    <!-- Menu Start -->
    {{-- <div class="container-xxl py-lg-5 px-md-5 py-4 px-3">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Simple, affordable, memorable
                </h5>
                <h1 class="mb-sm-5 mb-3">Live in moments that matter</h1>
            </div>
            @if ($products->isNotEmpty())
            <div class="row mx-0 d-flex align-items-start">
                <div class="col-lg-3 nav flex-lg-column nav-pills pe-0 bg-white menu-sidebar" id="v-pills-tab"
                    role="tablist" aria-orientation="vertical">
                    @foreach ($products as $index => $product)
                    <button class="text-start rounded-0 nav-link @if ($index == 0) active @endif"
                        id="v-pills-home-tab{{ $product->id }}" data-bs-toggle="pill"
                        data-bs-target="#menutab{{ $product->id }}" type="button" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">{{ $product->name }}</button>
                    @endforeach
                </div>
                <div class="col-lg-9 pe-0 ps-lg-3 ps-0 tab-content popular-carousel" id="v-pills-tabContent">
                    @foreach ($products as $index => $product)
                    @if ($product->products->isNotEmpty())
                    <div class="tab-pane fade @if ($index == 0) show active @endif" id="menutab{{ $product->id }}"
                        role="tabpanel" aria-labelledby="v-pills-tab-{{ $product->id }}">
                        <div class="row g-4">
                            @foreach ($product->products as $prod)
                            <div class="col-xl-4 col-md-6">
                                <a class="popular-item bg-transparent border rounded p-4 d-block text-start" href="#"
                                    data-bs-toggle="modal" data-bs-target="#menuModal-{{ $prod->id }}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="pe-3">
                                            <h5 class="mb-1 main-heading">{{ $prod->name }}</h5>
                                            <small>{{ $prod->price }}</small>
                                        </div>
                                        <img class="img-fluid flex-shrink-0 rounded-circle"
                                            src="{{ asset($prod->image) }}">
                                    </div>
                                    <p class="mb-0 mt-3">{!! $prod->description !!}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @else
            <div
                style="text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">
                <p style="font-size: 24px; margin-bottom: 0;">No Results Found!</p>
                <p style="font-size: 16px; margin-top: 0;">Sorry, we couldn't find any results matching your
                    search.</p>
            </div>

            @endif
        </div> --}}

    <div class="container-xxl py-lg-5 px-md-5 py-4 px-3">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Simple, affordable, memorable
            </h5>
            <h1 class="mb-sm-5 mb-3">Live in moments that matter</h1>
        </div>

        @if ($products->isNotEmpty())
            <div class="row mx-0 d-flex align-items-start">
                <div class="col-lg-3 nav flex-lg-column nav-pills pe-0 bg-white menu-sidebar" id="v-pills-tab"
                    role="tablist" aria-orientation="vertical">
                    @foreach ($products as $index => $product)
                        <button
                            class="text-start rounded-0 nav-link @if ($index == 0) active @endif"
                            id="v-pills-home-tab{{ $product->id }}" data-bs-toggle="pill"
                            data-bs-target="#menutab{{ $product->id }}" type="button" role="tab"
                            aria-controls="v-pills-home" aria-selected="true">{{ $product->name }}</button>
                    @endforeach
                </div>

                <div class="col-lg-9 pe-0 ps-lg-3 ps-0 tab-content popular-carousel" id="v-pills-tabContent">
                    @foreach ($products as $index => $product)
                        <div class="tab-pane fade @if ($index == 0) show active @endif"
                            id="menutab{{ $product->id }}" role="tabpanel"
                            aria-labelledby="v-pills-tab-{{ $product->id }}">
                            @if ($product->products->isNotEmpty())
                                <div class="row g-4">
                                    @foreach ($product->products as $prod)
                                        <div class="col-xl-4 col-md-6">
                                            <a class="popular-item bg-transparent border rounded p-4 d-block text-start"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#menuModal-{{ $prod->id }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="pe-3">
                                                        <h5 class="mb-1 main-heading">{{ $prod->name }}</h5>
                                                        {{-- <small>${{ $prod->price }}</small> --}}
                                                        @if ($prod->variants && $prod->variants->isNotEmpty())
                                                            <small>$<span
                                                                    class="prodPrice">{{ $prod->variants->first()->price }}</span></small>
                                                        @else
                                                            <small>${{ $prod->price }}</small>
                                                        @endif
                                                    </div>
                                                    <img class="img-fluid flex-shrink-0 rounded-circle"
                                                        src="{{ asset($prod->image) }}">
                                                </div>
                                                <p class="mb-0 mt-3">{!! $prod->description !!}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    style="text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">
                                    <p style="font-size: 24px; margin-bottom: 0;">No Results Found for
                                        {{ $product->name }}!</p>
                                    <p style="font-size: 16px; margin-top: 0;">Sorry, we couldn't find any results
                                        for this category.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div
                style="text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">
                <p style="font-size: 24px; margin-bottom: 0;">No Results Found!</p>
                <p style="font-size: 16px; margin-top: 0;">Sorry, we couldn't find any results matching your
                    search.</p>
            </div>
        @endif
    </div>

    {{-- Modalsss --}}
    @foreach ($products->flatMap->product as $prod)
        <div class="container-fluid cart food-modal wow fadeIn" data-wow-delay="0.1s">
            <div class="modal fade menu-modal" id="menuModal-{{ $prod->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body p-0 scrollable">
                            <input type="hidden" name="product_id" value="{{ $prod->id }}">
                            <img class="w-100" src="{{ asset($prod->image) }}" alt="product-img">
                            <div class="p-3 description">
                                <h3>{{ $prod->name }}</h3>
                                {{-- <p>US $ <span id="prodPrice">{{ $prod->price }}</span></p>
                                <h6>Select Option</h6>
                                <select class="form-control bg-white ps-1 select-size" style="appearance: auto">
                                    <option>13oz</option>
                                    <option>14oz</option>
                                    <option>15oz</option>
                                </select> --}}

                                @if (count($prod->variants) > 0)
                                    <p>US $ <span class="prodPrice">{{ $prod->variants->first()->price }}</span>
                                    </p>

                                    <select class="form-control bg-white ps-1 select-size" name="variant_id"
                                        id="sizeSelect" style="appearance: auto">
                                        @foreach ($prod->variants as $variant)
                                            <option value="{{ $variant->id }} {{ $variant->price }}">
                                                {{ $variant->size }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <h6 class="small mt-1 mb-3">Note: Prices vary depending on the selected size
                                    </h6>
                                @else
                                    <p>US $ <span class="prodPrice">{{ $prod->price }}</span></p>
                                @endif

                                <p class="small">{!! $prod->description !!}</p>
                                <div class="d-flex cart-btn">
                                    <button class="btn p-0 decrement" type="button">-</button>
                                    <input type="text" class="cart_input increment-input text-center"
                                        value="1" name="quantity" id="quantity_{{ $prod->id }}">
                                    <button class="btn p-0 increment" type="button">+</button>
                                </div>
                            </div>

                            <!-- Location Start -->
                            <div class="description p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="">How to get it</h6>
                                    <h6 class="text-danger">Required</h6>
                                </div>
                                <div class="d-flex align-items-start">
                                    <div class="form-check">
                                        <input class="mt-0 loc-input form-check-input" type="radio" checked
                                            id="location-1" name="location">
                                    </div>
                                    <label for="location-1" class="ms-1" style="cursor: pointer">
                                        <p class="small h6">Store Pickup</p>
                                        @foreach ($branches as $index => $branch)
                                            @if ($branch->status == 1)
                                                <input type="hidden" name="branch_id"
                                                    value="{{ $branch->id }}">
                                                <p class="small fw-bold m-0">{{ $branch->name }}</p>
                                                <p class="small fw-bold m-0 sel-location location-set">
                                                    {{ $branch->location }}
                                                </p>
                                            @endif
                                        @endforeach
                                        <input type="hidden" id="orderLocation" name="address"
                                            value="2562 Central Park Av yonkers, NY">
                                        <h6 class="mt-2 mb-0 chose-location"><a href="#"
                                                data-bs-toggle="modal" data-bs-target="#locationModal">Choose
                                                different
                                                location</a></h6>
                                    </label>
                                </div>
                            </div>
                            <!-- Location End -->

                            <!-- Toppings Start-->
                            <div class="p-3">
                                @if ($prod->category->isNotEmpty())
                                    @foreach ($prod->category as $index => $category)
                                        <div class="description p-3">
                                            <div class="arrow" style="cursor: pointer" data-bs-toggle="collapse"
                                                data-bs-target="#topping{{ $index }}{{ $category->id }}">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="m-0">{{ $category->getCategory->name }}</h6>
                                                    <h6 class="fw-normal m-0 d-flex align-items-center">Optional
                                                        <span class="h5 m-0 p-0 ri-arrow-up-s-line"></span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="collapse show"
                                                id="topping{{ $index }}{{ $category->id }}">
                                                @php
                                                    $categoryToppings = App\Models\CategoryTopping::where(
                                                        'category_id',
                                                        $category->getCategory->id,
                                                    )->get();
                                                @endphp
                                                @foreach ($categoryToppings as $categoryTopping)
                                                    <div class="d-flex justify-content-between">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="toppings[]"
                                                                id="toppingchek{{ $index }}{{ $category->id }}{{ $categoryTopping->topping->id }}"
                                                                value="{{ $categoryTopping->topping->id }}"
                                                                data-category-id="{{ $category->getCategory->id }}">
                                                            <label class="form-check-label m-0"
                                                                for="toppingchek{{ $index }}{{ $category->id }}{{ $categoryTopping->topping->id }}">
                                                                {{ $categoryTopping->topping->name }}
                                                            </label>
                                                        </div>
                                                        <p class="m-0">
                                                            {{ isset($categoryTopping->topping->price) ? '$' . $categoryTopping->topping->price : '' }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- Toppings End -->
                        </div>
                        <div class="modal-footer position-relative px-2">
                            <button type="button"
                                style="font-size: 24px;position: absolute;left: 0;width: 30px;height: 30px;display: flex;justify-content: center;align-items: center"
                                class="btn time-modal-close ri-close-circle-line btn-danger px-2 ms-3 py-0"
                                data-bs-dismiss="modal"></button>
                            <div class="text-center mx-auto">
                                <button class="btn btn-danger addto-cart px-sm-5 px-4" data-bs-dismiss="modal">Add
                                    To
                                    Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Location Modal Start -->

    <!--Location Modal End -->

    <!-- Menu End -->

</div>
</section>]
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
<script>
    $(function() {
        $(document).on('change', '.select-size', function() {
            let a = $(this).val().split(' ')[1];
            $(this).closest('.description').find('.prodPrice').text(a);
        })

        $('input:radio').on('click', function() {
            var chooseLocation = $('input[name="choosen_location"]:checked').siblings('label').find(
                '.branch-location').text();
            console.log(chooseLocation)
            $('.sel-location').text(chooseLocation);
            var dataBranchId = $(this).attr('data-branch-id');
            $('input[name="branch_id"]').val(dataBranchId);
        });

        $('.location-update-btn').click(function() {
            $('.location-radio').each(function() {
                if ($(this).is(':checked')) {
                    let c = $(this).siblings('.location-branch-parent').find('.branch-location')
                        .text();
                    c = c.trim();
                    $('.location-set').each(function() {
                        $(this).text(c);
                    });
                    return false;
                }
            })


        });
        $(document).on('click', 'input:radio', function() {
            var chooseLocation = $('input[name="choosen_location"]:checked').siblings('label').find(
                '.branch-location').text();
            $('.sel-location').text(chooseLocation);
        });

        $(document).on('click', 'a[data-bs-toggle="modal"]', function() {
            setTimeout(() => {
                $('.modal.show .loc-input').prop('checked', true);
            }, 200);
        })

        //Description Dealing
        $('.arrow').click(function() {
            let a = $(this).find('span');
            if (a.hasClass('ri-arrow-up-s-line')) {
                a.removeClass('ri-arrow-up-s-line')
                a.addClass('ri-arrow-down-s-line');
            } else {
                a.addClass('ri-arrow-up-s-line')
                a.removeClass('ri-arrow-down-s-line');
            }
        });
        //array to store the Google Map Location
        let arr = [{
            source: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3018.0477543418483!2d-73.84479512475968!3d40.84887532922607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f4ab4f07396d%3A0xe6c4ae3a2866d1b8!2sA%20Z%20Nutrition!5e0!3m2!1sen!2s!4v1700484957680!5m2!1sen!2s',
            locationHeading: 'Sugar Pappi',
            address1: '1578 Main Avenue Clifton, NJ 07011'
        }, {
            source: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.8769358092172!2d-73.82903412475196!3d40.98417552090991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2933bd5635a09%3A0x502bc89c049525ac!2s2562%20Central%20Park%20Ave%2C%20Yonkers%2C%20NY%2010710%2C%20USA!5e0!3m2!1sen!2s!4v1700483134249!5m2!1sen!2s',
            locationHeading: 'Sugar Pappi',
            address1: '2562 Central Park Av yonkers, NY 10710'
        }, {
            source: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3016.25629501146!2d-74.15504762475744!3d40.888192526811835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2fe99dc1b2ba9%3A0x84d65884be972356!2sA-Z%20Nutrition%26Smoothies!5e0!3m2!1sen!2s!4v1700485074231!5m2!1sen!2s',
            locationHeading: 'Sugar Pappi',
            address1: '1776 Eastchester Road Bronx, NY 10461'
        }, {
            source: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96659.29314183394!2d-74.34112495664061!3d40.79274319999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25566ba35d8cb%3A0x2cb13edad59b0cbc!2sAmazon%20Hub%20Counter%20-%20A-Z%20Nutrition%20%26%20Smoothies!5e0!3m2!1sen!2s!4v1700485211429!5m2!1sen!2s',
            locationHeading: 'Sugar Pappi',
            address1: '549 Bloomfield Avenue Bloomfield, NJ 07003'
        }, ];
        //Control Of Modals
        $('.chose-location').click(function() {
            $('#menuModal').modal('hide')
        });
        $('#locationModal').click(function() {
            event.stopPropagation();
            $('#menuModal').modal('show');
        });
        $('#locationModal .modal-dialog').click(function() {
            event.stopPropagation();
            $('#menuModal').modal('hide');
        });
        $('.location-close').click(function() {
            event.stopPropagation();
            $('#menuModal').modal('show');
            $('#locationModal').modal('hide')
        });
        $('#locationDescription').click(function() {
            event.stopPropagation();
            $('#locationModal').modal('show');
        });
        $('#locationDescription').click(function() {
            event.stopPropagation();
            $('#locationModal').modal('show');
        });
        $('#locationDescription .modal-dialog').click(function() {
            event.stopPropagation();
            $('#locationModal').modal('hide');
        });
        $('.location-description-btn').click(function() {
            $('#locationDescription').modal('hide');
            $('#locationModal').modal('show');
        });
        //this is updation of the Modal
        $('.location-description').each(function(index) {
            $(this).click(function() {
                event.stopPropagation();
                $('#locationModal').modal('hide');
                let i = index;
                let a = arr[i];
                //Changing location-description Modal;
                $('.locationHeading').text(a.locationHeading);
                $('.address1').text(a.address1);
                $('.address2').text(a.address2);
                $('iframe').attr('src', a.source);
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Get all increment and decrement buttons
        const incrementButtons = document.querySelectorAll('.increment');
        const decrementButtons = document.querySelectorAll('.decrement');

        // Attach click event listeners to each button
        incrementButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.cart_input');
                input.value = parseInt(input.value) + 1;
            });
        });

        decrementButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.cart_input');
                const value = parseInt(input.value) - 1;
                input.value = value >= 1 ? value : 1;
            });
        });
    });

    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-DD', // Adjust the format as needed
        yearRange: [1900, moment().year()], // Set the range of selectable years
        showYearDropdown: true, // Display a dropdown for selecting the year
        // You can customize other options as needed
        minDate: new Date() // Set the minimum date to the current date
    });

    $('.calender').click(function() {
        event.stopPropagation();
        $('.time_input').click();
    });

    $('.addto-cart').on('click', function() {
        var productId = $(this).closest('.food-modal').find('input[name="product_id"]').val();
        var quantity = $(this).closest('.food-modal').find('input[name="quantity"]').val();
        var isLocationChecked = $(this).closest('.food-modal').find('input[name="location"]:checked').length >
        0;
        var branchId = isLocationChecked ? $(this).closest('.food-modal').find('input[name="branch_id"]')
        .val() : '';
        var variantId = '';

        // Check if the product has variants
        var variantSelect = $(this).closest('.food-modal').find('select[name="variant_id"]');
        if (variantSelect.length > 0) {
            variantId = variantSelect.val().split(' ')[0];
        }

        // Initialize an object to store selected toppings by category
        var selectedToppingsByCategory = {};

        // Get selected toppings
        $(this).closest('.food-modal').find('input[name="toppings[]"]:checked').each(function() {
            var categoryId = $(this).data('category-id');
            var toppingId = $(this).val();

            // Check if category ID already exists in the object
            if (!selectedToppingsByCategory.hasOwnProperty(categoryId)) {
                selectedToppingsByCategory[categoryId] = [];
            }

            selectedToppingsByCategory[categoryId].push(toppingId);
        });

        // Convert the object to an array of objects
        var toppingsArray = Object.entries(selectedToppingsByCategory).map(([categoryId, toppings]) => {
            return {
                category_id: categoryId,
                toppings: toppings
            };
        });

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route('add.to.cart') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'product_id': productId,
                'quantity': quantity,
                'branch_id': branchId,
                'toppings_by_category': toppingsArray, // Sending toppings by category in array format
                'location': isLocationChecked,
                'variant_id': variantId
            },
            success: function(data) {
                toastr.success('Product Added To Cart Successfully!');
                updateCartUI(data);
            },
            error: function(error) {
                console.error('Error adding product to cart:', error);
            }
        });
    });

    function updateCartUI(data) {
        var cartItemCount = 0;
        var html = '';
        jQuery.each(data['cart'], function(i, product) {
            cartItemCount += parseInt(product.quantity);
            html += '<div class="carting-child px-3 mt-3 d-flex justify-content-between pb-3 border-bottom">';
            html += '<img src="' + product.image +
                '" alt=""><div class="content"><div class="d-flex justify-content-between">';
            html += '<h6 class="m-0" data-product-id="' + product.product_id + '">' + product.name;
            // Check if size exists and wrap it in a span within parentheses
            html += product.size ? ' (<span style="font-size: 12px;">' + product.size + '</span>)' : '';
            html += '</h6><h6 class="m-0 total-price">$' + (parseFloat(product.price) * product.quantity) +
                '</h6><p class="product-price d-none">' + product.price + '</p></div>';
            html += '<div class="mb-2"><h6 class="m-0">Toppings</h6>';

            {{--  $.each(product.topping_names, function(i, topping) {
                html += '<p class="small m-0">' + topping + '</p>';
            });  --}}
            $.each(product.toppingsName_by_categoryName, function(index, category) {
                html += '<h6 class="mt-2 mb-1">' + category.category_name +
                '</h6>'; // Display category name
                $.each(category.topping_names, function(i, topping) {
                    html += '<p class="small m-0">' + topping +
                    '</p>'; // Display each topping under the category
                });
            });

            html += '</div><div class="cart-btn">';
            html += '<button class="btn decrement-btn p-0" data-product-id="' + product.product_id + ',' +
                product.variant_id +
                '">-</button>';
            html += '<input type="number" value="' + product.quantity +
                '" class="increment-input cart_input text-center" data-product-id="' + product.product_id +
                '">';
            html += '<button class="btn increment-btn p-0" data-product-id="' + product.product_id + ',' +
                product.variant_id +
                '">+</button>';
            html += '</div></div></div>';
        });

        $('.cart-counter-1').text(cartItemCount);
        $('.cards-parent').html(html);
        // Add event listeners for increment and decrement buttons in the updated UI


        if (cartItemCount > 0) {
            $('.button-disable').removeClass('disabled');
        }

        function updateQuantity(productId, change) {
            var product = data['cart'].find(p => p.product_id === productId);
            if (product) {
                product.quantity += change;

                // Update the total price dynamically
                var totalElement = $('.total-price[data-product-id="' + productId + '"]');
                var newTotalPrice = '$' + ((parseFloat(product.price) * product.quantity).toFixed(2));
                totalElement.text(newTotalPrice);
            }
        }
    }

    $('.updateTimeBtnn').on('click', function() {
        var timeModal = $(this).closest('.time-modal');
        var date_input = timeModal.find('input[name="date_input"]').val();
        var selectedTime = timeModal.find('input[name="time-radio"]:checked').val();

        if (!selectedTime) {
            alert('Please select a time slot.');
            return;
        }

        // Store the selected time in local storage
        localStorage.setItem('selectedTime', selectedTime);

        $.ajax({
            type: 'POST',
            url: '{{ route('update.time') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'date_input': date_input,
                'time-radio': selectedTime,
            },
            success: function(data) {
                toastr.success('Time Updated Successful');
                setTimeout(function() {
                    location.reload();
                }, 500);
                timeModal.modal('hide');
            },
            error: function(error) {
                // Handle the error response, e.g., show an error message
                console.error('Error updating time:', error);
            }
        });
    });

    // When the page loads, set the checked state based on the stored value
    $(document).ready(function() {
        var storedTime = localStorage.getItem('selectedTime');
        if (storedTime) {
            $('input[name="time-radio"]').filter('[value="' + storedTime + '"]').prop('checked', true);
        }
    });

    // location update

    $('.updateLocationBtn').on('click', function() {
        // Find the selected radio button
        var selectedBranch = $('input[name="choosen_location"]:checked');

        if (selectedBranch.length === 0) {
            alert('Please select a location before updating.');
            return;
        }

        // Extract branch ID from the data attribute
        var branchId = selectedBranch.data('branch-id');

        // Send AJAX request to update branch status
        $.ajax({
            type: 'POST',
            url: '{{ route('update.branch.status') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'branch_id': branchId,
            },
            success: function(data) {
                toastr.success('Location Updated Successful');
                // setTimeout(function() {
                //     location.reload();
                // }, 500);
                console.log(response.message);
                // Reload the page after a short delay
                // setTimeout(function() {
                //     location.reload();
                // }, 500);
            },
            error: function(error) {
                console.error('Error updating branch status:', error);
            }
        });
    });
</script>
@endsection
