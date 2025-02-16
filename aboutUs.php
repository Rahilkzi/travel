<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>About Us | tourism_management</title>

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
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #008B8B;
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

		/* Hero Section */
		.hero {
			background: url('https://voyagerezine.com/wp-content/uploads/2023/10/Copia-de-vision-board-ideas-97.png') no-repeat center center/cover;
			color: white;
			text-align: center;
			padding: 120px 20px;
		}

		.hero h1 {
			font-size: 50px;
			margin: 0;
		}

		.hero p {
			font-size: 22px;
			margin-top: 10px;
		}

		/* About Section */
		.about {
			padding: 40px;
			text-align: center;
			background: white;
			margin: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.about p {
			font-size: 18px;
			line-height: 1.6;
		}

		/* Growth Section */
		.growth-section {
			display: flex;
			justify-content: center;
			gap: 20px;
			flex-wrap: wrap;
			margin: 20px;
		}

		.growth-box {
			text-align: center;
			width: 300px;
			background: white;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.growth-box img {
			width: 100%;
			border-radius: 10px;
		}

		.growth-box h3 {
			margin-top: 10px;
		}

		/* Testimonials */
		.testimonials {
			display: flex;
			justify-content: center;
			gap: 20px;
			flex-wrap: wrap;
			margin: 20px;
		}

		.testimonial {
			background: #f0f0f0;
			padding: 20px;
			border-radius: 10px;
			max-width: 300px;
			text-align: left;
		}

		/* Footer */
		footer {
			background: #333;
			color: white;
			padding: 10px;
			text-align: center;
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



		<!-- Hero Section with Background Image -->
		<div class="hero">
			<h1>About Us</h1>
			<p>Your journey to unforgettable experiences starts here!</p>
		</div>

		<!-- Who We Are Section -->
		<section class="about">
			<h2>Who We Are</h2>
			<p>At <strong>Dream Travels</strong>, we have been growing steadily, offering top-notch travel experiences
				worldwide. With thousands of happy travelers, we continue to expand our destinations, services, and
				customer satisfaction.</p>
		</section>

		<!-- Growth Section with 3 Images -->
		<section class="growth-section">
			<div class="growth-box">
				<img src="https://th.bing.com/th/id/OIP._dAd_UrnDNpvMc-iJgdupQHaFQ?w=693&h=492&rs=1&pid=ImgDetMain"
					alt="Our First Tour">
				<h3>Our First Adventure</h3>
				<p>We started with just a small group of travel enthusiasts, curating unique experiences.</p>
			</div>
			<div class="growth-box">
				<img src="https://th.bing.com/th/id/OIP.MsLZnSbjGA4XjEG1UqVwYAHaE8?rs=1&pid=ImgDetMain"
					alt="Expanding Destinations">
				<h3>Expanding Globally</h3>
				<p>Within a few years, we expanded to over 30+ exotic locations worldwide.</p>
			</div>
			<div class="growth-box">
				<img src="https://img.freepik.com/premium-photo/cinematic-friendship-creating-lasting-memories-with-friends_925962-19971.jpg"
					alt="Unforgettable Experiences">
				<h3>Creating Memories</h3>
				<p>We have served thousands of happy travelers, ensuring every trip is a dream come true.</p>
			</div>
		</section>

		<!-- Client Testimonials -->
		<section class="testimonials">
			<h2>What Our Clients Say</h2>
			<div class="testimonial">
				<p>"An incredible journey! Every detail was perfectly planned."</p>
				<strong>- Sarah W.</strong>
			</div>
			<div class="testimonial">
				<p>"The best travel company! Amazing locations and great service."</p>
				<strong>- Sumera Tole.</strong>
			</div>
			<div class="testimonial">
				<p>"My dream vacation became reality with Dream Travels!"</p>
				<strong>- Tasannum Haju.</strong>
			</div>
		</section>




	<div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->

	<?php include("common/footer.php"); ?>

</body>

<!-- BODY TAG ENDS -->

</html>