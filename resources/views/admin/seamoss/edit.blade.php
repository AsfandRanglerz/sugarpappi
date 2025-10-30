@extends('admin.layout.app')
@section('title', 'New!Seamoss')
@section('content')
    <!-- Include Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Link</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('seamoss.update', $data->id) }}" method="POST" id="seamossForm">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-12 col-lg-3 mt-2">Paste
                                            Link</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="video_link" id="video_link_input"
                                                value="{{ old('video_link', $data->video_link) }}"
                                                class="form-control custom-input" />
                                            @error('video_link')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7 text-center">
                                            <button type="button" class="btn btn-primary"
                                                onclick="changeInputType()">Update</button>
                                        </div>
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
    <script>
        function changeInputType() {
            var linkInput = document.getElementById('video_link_input');
            var linkValue = linkInput.value;

            // Check if the input looks like a URL
            if (/^(https?:\/\/)/.test(linkValue)) {
                linkInput.type = 'url';
            } else {
                linkInput.type = 'text';
            }
            // Submit the form (you can remove this if you don't want to submit the form automatically)
            document.getElementById('seamossForm').submit();
        }
    </script>

@endsection
