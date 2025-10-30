@extends('admin.layout.app')
@section('title', 'Term & Condation')
@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>NEW! SEAMOSS</h4>
                            </div>
                            <div class="card-body">
                                @if ($data)
                                    <!-- Data exists, hide the "Add Gallery" button -->
                                @else
                                    <a class="btn btn-success mb-3" href="{{ route('seasmoss.create') }}">Add Link</a>
                                @endif
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Video Link</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $data->video_link }}</td>
                                            <td><a href="{{ route('seasmoss.edit', $data->id) }}"><i class="fas fa-edit"></i></a></td>
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
@endsection
