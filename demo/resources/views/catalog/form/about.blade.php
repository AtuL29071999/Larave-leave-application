@extends('catalog.common.base')

@section('content')
    <style>
        .team-member {
            text-align: center;
            margin: 20px 0;
        }

        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-4">About Us</h1>

        <section class="mb-5">
            <h2>Our Mission</h2>
            <p>
                To provide the best service and products to our customers while maintaining a commitment to sustainability
                and community development.
            </p>
        </section>

        <section class="mb-5">
            <h2>Our Vision</h2>
            <p>
                To be the leading provider in our industry, recognized for our innovation and quality, and to create a
                positive impact on the world.
            </p>
        </section>

        <section class="mb-5">
            <h2>Our Values</h2>
            <ul>
                <li>Integrity</li>
                <li>Quality</li>
                <li>Innovation</li>
                <li>Teamwork</li>
                <li>Community</li>
            </ul>
        </section>

        <section>
            <h2>Meet Our Team</h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 1">
                    <h5>John Doe</h5>
                    <p>CEO</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 2">
                    <h5>Jane Smith</h5>
                    <p>CTO</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 3">
                    <h5>Mike Johnson</h5>
                    <p>Marketing Manager</p>
                </div>
            </div>
        </section>
    </div>
@endsection
