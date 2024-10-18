@extends('catalog.common.base')

@section('content')
    <style>
        body {
            background-color: #f0f2f5;
        }

        .signup-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #28a745;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .text-muted {
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <div class="signup-container">
        <h2>Sign Up</h2>
        {{--  --}}
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Upload Picture</label>
                <input type="file" class="form-control" id="image" name="profileimage">
                @if(isset($profile) && $profile->profileimage)
                    <img class="mt-2" height="50" src="{{ isset($profile) && property_exists($profile, 'profileimage') ? URL::asset('image/profile/' . $profile->profileimage) : '' }}" alt="">
                @endif
            </div>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value="{{ isset($profile) && property_exists($profile, 'fullName') ? $profile->fullName : '' }}" placeholder="Enter your full name"
                    required>
            </div>

            <button type="submit" class="btn btn-custom">Update Profile</button>
        </form>
    </div>
@endsection
