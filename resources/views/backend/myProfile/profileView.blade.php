@extends('backend.layout')

@section('backend_content')
    <div class="container mt-3">
        <div class="card p-2">
            <div class="info d-flex align-items-center">
                <div class="image">
                    <img id="blah" width="80px"
                        src="{{ Auth::user()->profile_image ? asset('storage/profileImages/' . Auth::user()->profile_image) : asset('assets/img/avatars/1.png') }}"
                        alt="">
                </div>
                <div class="details ms-3">
                    <h3 class="m-0">{{ Auth::user()->name }}</h3>
                    <p class="m-0">{{ Auth::user()->title }}</p>
                    <form action="{{ route('dashboard.my.profile.image') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name="profile_image" hidden accept="image/*" type='file' id="imgInp" />
                        <div class="d-flex gap-2">

                            <label for="imgInp">
                                <span class="btn btn-outline-primary d-flex align-items-center gap-2 mt-2">Upload image
                                    <iconify-icon icon="mingcute:upload-3-line" width="24" height="24"></iconify-icon>
                                </span>
                            </label>

                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 mt-2">Save image
                                <iconify-icon icon="carbon:save" width="24" height="24"></iconify-icon>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="description">
                <p class="mt-2 mb-0">
                    {{ Auth::user()->description }}
                </p>
            </div>
        </div>

        <div class="card mt-3 p-2">
            <div class="card-header">
                <h3>User Info</h3>
            </div>
            <form action="{{ route('dashboard.my.profile.info') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 p-3">
                        @csrf
                        <label for="name">Name</label>
                        <input class=" mb-2 form-control" type="text" id="name" name="name"
                            value="{{ Auth::user()->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="email">Email</label>
                        <input class=" mb-2 form-control" type="email" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="title">Title</label>
                        <input class=" mb-2 form-control" type="text" id="title" name="title"
                            value="{{ Auth::user()->title }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">save</button>
                    </div>

                    <div class="col-lg-6 p-3">


                        <label for="phone">Phone </label>
                        <input class=" mb-2 form-control" type="text" id="phone" name="phone"
                            value="{{ Auth::user()->phone }}">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="description">Description</label>
                        <textarea class=" mb-2 form-control" type="text" id="description" name="description"
                            value="{{ Auth::user()->description }}"></textarea>


                    </div>
                </div>
            </form>


            <div class="head">
                <h4>Update Password</h4>
            </div>
            <form action="{{ route('dashboard.my.profile.pass') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 p-3">
                        @csrf
                        <label for="current_pass">Current password</label>
                        <input class=" mb-2 form-control" type="password" id="current_pass" name="current_pass" value="">
                        @if (session('error'))
                            <p class="text-danger"> {{ session('error') }}</p>
                        @endif
                        <label for="new_pass">New password</label>
                        <input class=" mb-2 form-control" type="password" id="new_pass" name="new_pass" value="">
                        <label for="confirm_pass">Confirm password</label>
                        <input class=" mb-2 form-control" type="password" id="confirm_pass" name="confirm_pass" value="">
                        @if (session('confirm_error'))
                            <p class="text-danger"> {{ session('confirm_error') }}</p>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('backend_js')
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>

    <script>

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
