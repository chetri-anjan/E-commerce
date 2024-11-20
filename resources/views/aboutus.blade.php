@extends('layout')
@section('content')

<style>
   /* about-us.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.about-us {
    padding: 40px 20px;
    background-color: #ffffff;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

p {
    font-size: 1.1em;
    line-height: 1.6;
    color: #666;
    text-align: center;
    margin-bottom: 20px;
}

.mission-vision {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

.mission, .vision {
    width: 48%;
}

.mission h2, .vision h2 {
    font-size: 2em;
    margin-bottom: 10px;
    color: #333;
}

.team {
    margin-bottom: 40px;
}

.team h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.team-member {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.team-member img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.team-member h3 {
    margin: 0;
    font-size: 1.5em;
    color: #333;
}

.team-member p {
    margin: 5px 0;
    color: #666;
}

.contact {
    text-align: center;
}

.contact h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #333;
}

.contact a {
    color: #007bff;
    text-decoration: none;
}

.contact a:hover {
    text-decoration: underline;
}

/* Responsive Design */

@media (max-width: 768px) {
    .mission-vision {
        flex-direction: column;
    }

    .mission, .vision {
        width: 100%;
        margin-bottom: 20px;
    }

    .team-member {
        flex-direction: column;
        align-items: flex-start;
    }

    .team-member img {
        margin-bottom: 10px;
    }
}

</style>


<section class="about-us">
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to [Your Store Name], where we believe in delivering exceptional products and experiences to our customers. Our journey began with a vision to offer high-quality, unique products that bring joy and satisfaction to every customer.</p>

        <div class="mission-vision">
            <div class="mission">
                <h2>Our Mission</h2>
                <p>Our mission is to provide top-notch products and services that exceed our customers' expectations. We are committed to quality, integrity, and excellence in everything we do.</p>
            </div>
            <div class="vision">
                <h2>Our Vision</h2>
                <p>We aim to be the leading e-commerce destination for [Your Industry/Products], known for our unparalleled customer service and innovative approach. Our vision is to create a shopping experience that is both enjoyable and memorable.</p>
            </div>
        </div>

        <div class="team">
            <h2>Meet the Team</h2>
            <div class="team-member">
                <!-- <img src="/images/team-member1.jpg" alt="Team Member 1"> -->
                <h3>John Doe</h3>
                <p>Founder & CEO</p>
                <p>John is the visionary behind [Your Store Name]. With a passion for innovation and customer satisfaction, John leads our team with dedication and expertise.</p>
            </div>
            <div class="team-member">
                <!-- <img src="/images/team-member2.jpg" alt="Team Member 2"> -->
                <h3>Jane Smith</h3>
                <p>Chief Operating Officer</p>
                <p>Jane ensures that our operations run smoothly and efficiently. Her organizational skills and attention to detail are key to our success.</p>
            </div>
        </div>

        <div class="contact">
            <h2>Contact Us</h2>
            <p>If you have any questions or would like to get in touch with us, please feel free to contact us at <a href="mailto:info@yourstore.com">info@yourstore.com</a> or follow us on social media.</p>
        </div>
    </div>
</section>

@endsection
