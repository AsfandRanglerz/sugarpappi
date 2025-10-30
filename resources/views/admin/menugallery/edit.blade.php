@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')

    <body>
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <a class="btn btn-primary mb-3" href="{{ url()->previous() }}">Back</a>
                    <form id="add_student" action="{{ route('menuGallery.update', $menuGallery->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <h4 class="text-center my-4">Update Gallery</h4>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-2 col-md-6 col-lg-6">
                                            <label>Previous Image</label>
                                            @if ($menuGallery->image)
                                                <img src="{{ asset($menuGallery->image) }}" alt="Previous Image"
                                                    class="img-thumbnail">
                                            @else
                                                <p class="text-danger">No previous image available.</p>
                                            @endif
                                        </div>
                                        <div class="form-group mb-2 col-md-6 col-lg-6">
                                            <label>Choose New Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success mr-1 btn-bg"
                                        id="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </body>
@endsection

@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
