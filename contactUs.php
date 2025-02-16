<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Contact Us | tourism_management</title>

	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700"
		rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<style>
		/* General Styles */
		body {
			font-family: 'Raleway', sans-serif;
			margin: 0;
			padding: 0;
			background: linear-gradient(135deg, #008B8B, #fad0c4);
			color: white;
		}

		/* Header Section */
		.header {
			background: white;
			padding: 15px 20px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.logo {
			font-size: 24px;
			font-weight: bold;
			color: #008B8B;
		}

		.headerMenu ul {
			list-style: none;
			padding: 0;
			margin: 0;
			display: flex;
		}

		.headerMenu ul li {
			margin: 0 15px;
			padding: 10px;
			cursor: pointer;
		}

		.headerMenu ul li.active {
			font-weight: bold;
			color: #008B8B;
		}

		.headerMenu ul a {
			text-decoration: none;
			color: black;
		}

		/* Contact Section Layout */
		.contact-container {
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			padding: 50px 5%;
		}

		/* Contact Form */
		.contact-form {
			background: white;
			color: black;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
			width: 45%;
		}

		.contact-form h2 {
			color: black;
			margin-bottom: 20px;
			text-align: center;
		}

		.contact-form form {
			display: flex;
			flex-direction: column;
		}

		.contact-form input,
		.contact-form textarea {
			width: 100%;
			padding: 10px;
			margin: 10px 0;
			border: 1px solid black;
			border-radius: 5px;
		}

		.contact-form .contactButton {
			background: black;
			color: white;
			padding: 12px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: 0.3s;
		}

		.contact-form .contactButton:hover {
			background: #black;
		}

		/* Google Map */
		.map {
			width: 45%;
			height: 350px;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
		}

		/* Located At Section */
		.contact-info {
			background: white;
			color: black;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
			width: 50%;
			margin: 30px auto;
			text-align: center;
		}

		.contact-info h2 {
			color: black;
		}

		.contact-info p {
			font-size: 18px;
			margin: 10px 0;
		}

		/* Social Media Icons */
		.social-icons {
			margin-top: 15px;
		}

		.social-icons a {
			text-decoration: none;
			font-size: 50px;
			margin: 0 15px;
			color: #black;
			transition: 0.3s;
		}

		.social-icons a:hover {
			color: #ffcc00;
			transform: scale(1.1);
		}

		/* Footer */
		footer {
			background: #222;
			color: white;
			padding: 15px;
			text-align: center;
			margin-top: 20px;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.contact-container {
				flex-direction: column;
				align-items: center;
			}

			.contact-form,
			.map {
				width: 100%;
				margin-bottom: 20px;
			}

			.contact-info {
				width: 90%;
			}
		}
	</style>

</head>

<!-- HEAD TAG ENDS -->

<!-- BODY TAG STARTS -->

<body>

	<?php

	if (!isset($_SESSION["username"])) {
		include("common/headerTransparentLoggedOut.php");
	} else {
		include("common/headerTransparentLoggedIn.php");
	}

	?>
	<div class="spacer">a</div>
<!-- Contact Section -->
<div class="contact-container">
        <!-- Contact Form (Left Side) -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form id="contactForm">
                <label for="name">Full Name:</label>
                <input type="text" name="name" required/>

                <label for="email">E-mail:</label>
                <input type="email" name="email" required/>

                <label for="queries">Queries:</label>
                <textarea name="queries" required></textarea>

                <div class="text-center">
                    <input type="submit" class="contactButton" value="Send"/>
                </div>
            </form>
        </div>

        <!-- Google Map (Right Side) -->
        <div class="map">
            <h2>OUR LOCATION:</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.576941597726!2d73.315721!3d16.994444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdf23f2e1b8cfbf%3A0x82b0ef76f0a0b6c2!2sRatnagiri%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1707219000000"
                width="100%" height="200%" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <!-- "We're Located At" Section (Centered Below) -->
    <div class="contact-info">
        <h2>We're located at:</h2>
        <p><i class="fa fa-map-marker"></i> Ratnagiri, Maharashtra, India</p>
        <p><i class="fa fa-phone"></i> +91 98765 43210</p>
        <p><i class="fa fa-envelope"></i> info@dreamtravels.com</p>

        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
        </div>
    </div>


	<div class="col-xs-12 spacer">.</div> <!-- just a dummy class for creating some space -->
	<div class="col-xs-12 spacer">.</div> <!-- just a dummy class for creating some space -->

	<?php include("common/footer.php"); ?>

</body>

<!-- BODY TAG ENDS -->

</html>