@extends('home.layout.app')
@section('title', 'Login')
@section('content')
@php
$userId = Auth::guard('user')->id();
$user = App\Models\User::find($userId);
$reward = App\Models\Reward::where('user_id', $userId)->first();
if ($reward) {
    $remaining = $reward->rewards - $reward->redeemed;
}
@endphp
<section class="section">
    <div class="container-xxl bg-white p-0">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-lg-5 pt-lg-5 pb-lg-4">
                    <h1 class="display-3 text-white animated slideInDown">Loyalty Points</h1>
                    <h5 class="text-white animated slideInDown">For every dollar spent on an order, you'll earn 1 point</h5>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Contact Start -->
        <div class="container-xxl">
            <div class="p-xl-5 p-4 col-sm-8 col-11 mx-auto bg-dark">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Loyalty Points</h5>
                    <h1 class="mb-xl-5 mb-4 text-white">Receive a $5 reward upon reaching 150 points</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered text-white">
                            <tbody>
                                <tr>
                                    <th>Points Earned</th>
                                    <th>Total $</th>
                                    <th>Remaining $</th>
                                    <th>Redeemed $</th>
                                </tr>
                                <tr>
                                    <td>{{ $user->point ?? '0' }}</td>
                                    <td>{{ $reward->rewards ?? '0' }} $</td>
                                    <td>{{ $remaining ?? '0' }} $</td>
                                    <td>{{ $reward->redeemed ?? '0' }} $</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.2s">

                </div>
            </div>
        </div>
        <!-- Contact End -->
    </div>
</section>
@endsection
@section('js')
@if (\Illuminate\Support\Facades\Session::has('message'))
<script>
    toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
</script>
@endif
@endsection
