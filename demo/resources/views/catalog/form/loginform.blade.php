@extends('catalog.common.base')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(90deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }


        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .text-muted {
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <div class="login-container">
        <h2>Login</h2>
        {{-- Handle errors here --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        {{-- {{ route('catalog.login.submit') }} --}}
        <form action="{{ $action }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                    required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
        <p class="text-muted">Don't have an account? <a href="{{ route('catalog.signup') }}">Sign up</a></p>
    </div>
@endsection
