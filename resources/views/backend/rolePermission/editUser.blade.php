@extends('backend.layout')
@section('backend_content')

    <div class="card p-3 m-2">



        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5 class="mb-0">Edit user</h5>
            <a href="{{ route('dashboard.rolePermission.user.list') }}" class="btn btn-primary">List users</a>
        </div>

        <div class="card-body">
            <form action="{{ route('dashboard.rolePermission.user.update', $userEdit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-4 text-center position-relative">
                        <span class="remove_btn"
                            style="position: absolute; line-height: 0; right: 49px; top: -8px; color: red; border: 1px solid red;  display: none; align-items: center; padding: 8px; border-radius: 10px; cursor: pointer; ">
                            <iconify-icon icon="pajamas:remove" width="16" height="16"></iconify-icon>
                        </span>
                        <label for="imgInp">
                            <img id="user_image"
                                style="max-width: 200px; width: 100%; border: 1px solid #00000024; padding: 20px; cursor: pointer;"
                                class="img-fluid" src="{{ $userEdit->profile_image ? asset('storage/profileImages/' . $userEdit->profile_image) : asset('assets/img/uplode-image.jpg') }}" alt="">
                        </label>
                        <input name="user_image" hidden accept="image/*" type='file' id="imgInp" />
                        @error('user_image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="user_name">User Name</label>
                                <input class="form-control" name="user_name" id="user_name" value="{{ $userEdit->name }}" type="text">

                                @error('user_name')
                                    <p class="text-danger">{{ $message }}</p>

                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="user_email">User Email</label>
                                <input class="form-control" name="user_email" id="user_email" value="{{ $userEdit->email }}" type="text">
                                @error('user_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="user_pass">User password</label>
                                <input class="form-control" name="user_pass" id="user_pass" value="" type="password">
                                @error('user_pass')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="user_confirm_password">Confirm password</label>
                                <input class="form-control" name="user_confirm_password" id="user_confirm_password" value=""
                                    type="password">
                                    @if (session('error'))
                                        <p class="text-danger">{{ session('error') }}</p>
                                    @endif

                            </div>
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>


    </div>

@endsection
@push('backend_js')
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>

    <script>
        let defaultImage = `{{ asset('assets/img/uplode-image.jpg') }}`;


        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                user_image.src = URL.createObjectURL(file)
                $('.remove_btn').show()
            }
        }

        $('.remove_btn').on('click', function () {
            $('#user_image').attr('src', defaultImage)
            $('.remove_btn').hide()
        })
    </script>
@endpush
