@extends('branch.layout.app')
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
                                    <h4>Branches</h4>
                                </div>
                            </div>
                            <div class="card-body table-striped table-bordered table-responsive">

                                <table class="table text-center" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Branch Number</th>
                                            <th>Branch Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Location</th>
                                            <th>Pick Up Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $branch)
                                            @if (auth()->guard('branch')->user()->id == $branch->id)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $branch->branch_number }}</td>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>{{ $branch->email }}</td>
                                                    <td>{{ $branch->phone_number }}</td>
                                                    <td>{{ $branch->location }}</td>
                                                    {{-- <td>
                                                        <button type="button" class="btn btn-primary " data-toggle="modal"
                                                            data-target="#addScheduleModal{{ $branch->id }}">
                                                            Add Schedule
                                                        </button>
                                                    </td> --}}
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#addPickUpScheduleModal{{ $branch->id }}">
                                                            Add
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- #############AddSchedules Modal################ --}}
    {{-- @foreach ($branches as $branch)
        @if (auth()->guard('branch')->user()->id == $branch->id)
            <div class="modal fade" id="addScheduleModal{{ $branch->id }}" tabindex="-1"
                aria-labelledby="addScheduleModalLabel{{ $branch->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addScheduleModalLabel{{ $branch->id }}">Add Schedule for
                                {{ $branch->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-success mb-2" id="addTiming{{ $branch->id }}">Add
                                Timing</button>
                            <form method="POST" id="scheduleForm">
                                <div class="schedule-container" id="timings">
                                    <!-- Existing or initially added fields here -->
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save-changes-btn"
                                data-branch-id="{{ $branch->id }}">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach --}}
    {{-- #############AddSchedules Modal################ --}}

    {{-- ################## ADD PickUp Schedule #################### --}}
    @foreach ($branches as $branch)
        @if (auth()->guard('branch')->user()->id == $branch->id)
            <div class="modal fade" id="addPickUpScheduleModal{{ $branch->id }}" tabindex="-1"
                aria-labelledby="addPickUpScheduleModal{{ $branch->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPickUpScheduleModal{{ $branch->id }}">Add PickUp Schedule for
                                {{ $branch->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="pickUpForm">
                                <div class="form-group col-8">
                                    <label>PicK Up Time</label>
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control timepicker" name="pickup_time"
                                            value="{{ $branch->pickup_time }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save-changes-btn"
                                data-branch-id="{{ $branch->id }}">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    {{-- ################## PickUp Schedule End #################### --}}

@endsection

@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#table_id_events').DataTable()

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Add this to your layout file, before the Bootstrap JavaScript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('js')
    {{-- ############## TIME PICK UP AJAX CODE --}}

    <script>
        function savePickUpSchedule(branchId, pickupTime) {
            $.ajax({
                url: '{{ route('save.pickup.schedule') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    branch_id: branchId,
                    pickup_time: pickupTime
                },
                success: function(response) {
                    $('#addPickUpScheduleModal' + branchId).modal('hide');
                    toastr.success('PickUp Schedule Added Successfully');
                },
                error: function(error) {
                    console.error('Error saving PickUp schedule:', error);
                }
            });
        }
        $(document).ready(function() {
            $('.save-changes-btn').on('click', function() {
                let branchId = $(this).data('branch-id');
                let pickupTime = $('#addPickUpScheduleModal' + branchId + ' input[name="pickup_time"]')
                    .val();
                savePickUpSchedule(branchId, pickupTime);
            });
        });
    </script>

    {{-- ####################Schedule apppends code ###################  --}}
    {{-- <script>
        $(document).ready(function() {
            // Handling click on "Add Timing" button to append fields
            $('[id^="addTiming"]').on('click', function() {
                let branchId = $(this).attr('id').replace('addTiming', '');
                let scheduleContainer = $('#timings');

                // Append schedule item with delete button
                scheduleContainer.append(`
    <div class="row schedule-row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="day">Day</label>
                <select class="form-control" name="name" required>
                    <option disabled selected>Select Days</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="start_time">Starting Time</label>
                <input type="time" class="form-control" name="start_time" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" class="form-control" name="end_time" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group"  style="margin-top: 4.5vh;">
    <button type="button" class="btn btn-danger btn-lg delete-schedule">
        <i class="fas fa-trash"></i>
    </button>
</div>

        </div>
    </div>
`);
                // Add click event handler for the delete button
                scheduleContainer.on('click', '.delete-schedule', function() {
                    $(this).closest('.schedule-row').remove();
                });

            });

            function getScheduleArray() {
                let arrValues = [];
                $('#timings' + ' .schedule-row').each(function() {
                    let rowValue = {};
                    $(this).find('[name^="name"], [name^="start_time"], [name^="end_time"]').each(
                        function() {
                            rowValue[$(this).attr('name')] = $(this).val();
                        });
                    arrValues.push(rowValue);
                });
                return arrValues;
            }


            function saveScheduleData(branchId) {
                let scheduleData = getScheduleArray();

                $.ajax({
                    url: '{{ route('save.schedule') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        branch_id: branchId,
                        schedule_data: scheduleData
                    }),
                    success: function(response) {
                        $('#addScheduleModal{{ $branch->id }}').modal('hide');
                        toastr.success('Schedule Added Successfully')

                    },
                    error: function(error) {
                        console.error('Error saving schedule data:', error);
                    }
                });
            }

            // Example of calling the Ajax function when a button is clicked
            $('.save-changes-btn').on('click', function() {
                let branchId = $(this).data('branch-id');
                saveScheduleData(branchId);
            });
        });
    </script> --}}
    {{-- ####################Schedule apppends code ###################  --}}


@endsection

@endsection
