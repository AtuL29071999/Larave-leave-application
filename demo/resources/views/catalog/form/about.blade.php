@extends('catalog.common.base')

@section('content')
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        h1,
        h2 {
            font-weight: bold;
        }

        /* Team Section */
        .team-member img {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: 3px solid #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .team-member img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .team-member h5 {
            margin-top: 15px;
            font-size: 1.2rem;
        }

        /* Founder Section */
        .founder img {
            border-radius: 50%;
            border: 5px solid #007bff;
            width: 200px;
            height: 200px;
            transition: transform 0.3s ease-in-out;
        }

        .founder img:hover {
            transform: scale(1.1);
        }

        /* Mission and Vision Section */
        .mission-vision {
            background: linear-gradient(120deg, #007bff, #6610f2);
            color: white;
            padding: 60px 0;
            border-radius: 10px;
        }

        .mission-vision h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .mission-vision p {
            font-size: 1.1rem;
            text-align: justify;
        }

        /* Section Headings */
        .section-heading {
            font-size: 2.5rem;
            color: #007bff;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .sub-heading {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
    </style>
    <!-- About Section -->
    <section class="container my-5">
        <div class="text-center mb-5">
            <h1 class="section-heading">About Us</h1>
            <p class="sub-heading">Team1 Consulting is an emerging startup in the IT infrastructure, software, cyber
                security, cloud solutions, and generative AI domains. As a premier system integrator, we specialize in
                delivering cutting-edge IT solutions tailored to drive innovation and accelerate business growth. Our
                expertise empowers organizations across industries to thrive in the digital era with customized, high-impact
                solutions that ensure success in an ever-evolving landscape.</p>
        </div>


        <!-- Founder Section -->
        <div class="row mt-5">
            <h2 class="text-center section-heading">Our Founders</h2>

            <div class="col-md-6 text-center founder">
                <img src="https://media.licdn.com/dms/image/v2/C4E03AQHqD36a1asSRQ/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1575615615126?e=1733356800&v=beta&t=v-q6IVMoVs85ViPWpEH3ZNqzlkkcPZqCM4HbpS_khNk"
                    class="img-fluid mb-3" alt="Founder 1 Image" style="width:200px; height:200px;">
                <h5>Amit Seth</h5>
                <p>Founder & CEO</p>
            </div>

            <div class="col-md-6 text-center founder">
                <img src="https://team1consulting.com/assets/img/founder-message-images/image-6.jpg" class="img-fluid mb-3"
                    alt="Founder 2 Image" style="width:200px; height:200px;">
                <h5>Harneet Seth</h5>
                <p>Co-Founder & CEO</p>
            </div>
        </div>

        <!-- Team Section -->
        <div class="container text-center my-5">
            <h2 class="section-heading">Our Team</h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <img src="https://team1consulting.com/assets/img/founder-message-images/image-3.jpg" class="img-fluid mb-3" alt="Team Member 1"
                        style="width:180px; height:180px; object-fit: cover;">
                    <h5>Finance Department</h5>
                    {{-- <p>Lead Developer</p> --}}
                </div>
                <div class="col-md-4 team-member">
                    <img src="https://team1consulting.com/assets/img/founder-message-images/founder-message.jpg" class="img-fluid mb-3" alt="Team Member 2"
                        style="width:180px; height:180px; object-fit: cover;">
                    <h5>HR Department</h5>
                    {{-- <p>Project Manager</p> --}}
                </div>

                <div class="col-md-4 team-member">
                    <img src="https://media.licdn.com/dms/image/v2/D5622AQHudmOIkYtbwg/feedshare-shrink_2048_1536/feedshare-shrink_2048_1536/0/1722840852849?e=1730937600&v=beta&t=nv_ypoWiK9qdGn81N56LVYnaqaS2sf3mKWY_LDxcg70" class="img-fluid mb-3" alt="Team Member 2"
                        style="width:180px; height:180px; object-fit: cover;">
                    <h5>IT Department</h5>
                    {{-- <p>Project Manager</p> --}}
                </div>

            </div>
        </div>



    </section>

    <!-- Mission and Vision Section -->
    <section class="container-fluid mission-vision">
        <div class="container">
            <div class="row">
                <!-- Vision -->
                <div class="col-md-6">
                    <h2 class="text-center">Our Vision</h2>
                    <p>To revolutionize the tech industry with innovative and sustainable solutions, empowering businesses
                        worldwide to thrive in a digital era. We envision a future where technology bridges gaps, fosters
                        creativity, and builds lasting connections.</p>
                </div>
                <!-- Mission -->
                <div class="col-md-6">
                    <h2 class="text-center">Our Mission</h2>
                    <p>Our mission is to deliver cutting-edge technology solutions that drive efficiency, growth, and
                        success for our clients while fostering a culture of innovation, integrity, and collaboration. We
                        are committed to continuous improvement and making a positive impact on the world.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
