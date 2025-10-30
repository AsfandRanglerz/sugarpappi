@extends('admin.layout.app')
@section('title', 'index')
@section('content')
<div class="main-content" style="min-height: 562px;">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <h4>Users</h4>
                            </div>
                        </div>
                        <div class="card-body table-striped table-bordered table-responsive">

                            <table class="table text-center" id="table_id_events">
                                <thead>
                                    <tr>
                                        <th>Points Earned</th>
                                        <th>Total $</th>
                                        <th>Remaining $</th>
                                        <th>Redeemed $</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->point ?? '0' }}</td>
                                        <td>{{ $userRewards->rewards ?? '0' }} $</td>
                                        <td>{{ $remaining ?? '0' }} $</td>
                                        <td>{{ $userRewards->redeemed ?? '0' }} $</td>
                                    </tr>
                                </tbody>
                            </table>
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
    $(document).ready(function() {
            $('#table_id_events').DataTable()

        })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


@endsection
