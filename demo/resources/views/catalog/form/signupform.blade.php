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
                <input type="file" class="form-control" id="image" name="profileimage" value="" placeholder=""
                    required>
            </div>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value="" placeholder="Enter your full name"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter your email"
                    required>
                @if (Session::has('email_error'))
                    <div class="p-1 mt-1 alert alert-danger alert-dismissible fade show fs-6" role="alert">
                    {{ Session::get('email_error') }}
                    <button type="button" class="btn-close p-1 fs-6 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                    required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                    placeholder="Confirm your password" required>
                    @if (Session::has('password_error'))
                    <div class="p-1 mt-1 alert alert-danger alert-dismissible fade show fs-6" role="alert">
                    {{ Session::get('password_error') }}
                    <button type="button" class="btn-close p-1 fs-6 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
                @endif
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Select Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="termsCheck" name="termsCheck" required>
                <label class="form-check-label" for="termsCheck">I agree to the <a href="#">terms and
                        conditions</a></label>
            </div>
            <button type="submit" class="btn btn-custom">Sign Up</button>
        </form>

        <p class="text-muted">Already have an account? <a href="{{ route('catalog.login') }}">Login here</a></p>
    </div>
@endsection
