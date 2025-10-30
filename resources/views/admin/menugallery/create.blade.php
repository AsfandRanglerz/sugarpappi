@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')

    <body>
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <form action="{{ route('menugallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <h4 class="text-center my-4">Add Menu Gallery</h4>
                                <div class="container">
                                    <div class="col-sm-12 ">
                                        <div class="form-group mb-2">
                                            <label>Image</label>
                                            <input type="file" placeholder="Image" name="image" id="image"
                                                class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success mr-1 btn-bg" id="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        </div>

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
