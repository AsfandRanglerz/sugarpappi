@extends('admin.layout.app')
@section('title', 'index')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-12">
                                    <h4>Time Slot</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="row" action="{{ route('time-slot.store') }}">
                                @csrf
                                <div class="form-group col-md-6 col-sm-12 col-lg-6">
                                    <label>Start Time</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="start_pickup_time"
                                            value="{{ $existingTimeSlot->start_pickup_time ?? old('start_pickup_time') }}">
                                    </div>
                                    @error('start_pickup_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-12 col-lg-6">
                                    <label>End Time</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="end_pickup_time"
                                            value="{{ $existingTimeSlot->end_pickup_time ?? old('end_pickup_time') }}">
                                    </div>
                                    @error('end_pickup_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                    <div class="col-12 text-center">
                                        @if ($existingTimeSlotsCount > 0)
                                            <button type="submit" class="btn btn-success" name="action"
                                                value="update">Update</button>
                                        @else
                                            <button type="submit" class="btn btn-primary" name="action"
                                                value="add">ADD</button>
                                        @endif
                                    </div>
                                </form>
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
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Add this to your layout file, before the Bootstrap JavaScript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
