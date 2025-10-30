
@extends('admin.layout.app')
@section('title', 'index')

@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header" style="padding-bottom: 0!important;border-bottom: 0">
                                <div class="col-12">
                                    <h4>Daily Sales Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>OrderId: {{ $weeklySales->order->code }}</p>
                                        <p>User: {{ $weeklySales->order->user->name }}</p>
                                        <p>Product: {{ $weeklySales->product->name }}</p>
                                        <p>Branch Location: {{ $weeklySales->branch->location }}</p>
                                        @if ($weeklySales && $weeklySales->product)
                                            <p>Price: ${{ $weeklySales->product->price }}</p>
                                            <p>Product Quantity:{{ $weeklySales->quantity }}</p>
                                            <p>Product SubTotal:{{ $weeklySales->sub_total }}</p>

                                            @if ($weeklySales->product->topping && $weeklySales->product->topping->isNotEmpty())
                                                <p>Toppings:</p>
                                                <ul>
                                                    @foreach ($weeklySales->product->topping as $topping)
                                                        <li>
                                                            Topping: {{ $topping->gettoping->name }}
                                                            (Price: ${{ $topping->gettoping->price }})
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No Toppings</p>
                                            @endif
                                        @endif

                                        <!-- Add more details as needed -->
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif

    <script>
        $('.tableExports').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Add this to your layout file, before the Bootstrap JavaScript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

