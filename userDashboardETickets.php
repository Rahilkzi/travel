<?php session_start();
if (!isset($_SESSION["username"])) {
	header("Location:blocked.php");
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Dashboard | tourism_management</title>

	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700"
		rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/userDashboard.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.js"></script>
	<script src="js/bootstrap-dropdown.js"></script>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>

</head>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectmeteor";

// Creating a connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking if successfully connected to the database
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>

<body>

	<div class="container-fluid">

		<div class="col-sm-12 userDashboard text-center">

			<?php include("common/headerDashboardTransparentLoggedIn.php"); ?>

			<div class="col-sm-12">
				<div class="heading text-center">
					My Dashboard
				</div>
			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-3 containerBoxLeft">

				<a href="userDashboardProfile.php">
					<div class="col-sm-12 menuContainer bottomBorder">
						<span class="fa fa-user-o"></span> My Profile
					</div>
				</a>

				<a href="userDashboardBookings.php">
					<div class="col-sm-12 menuContainer bottomBorder">
						<span class="fa fa-copy"></span> My Bookings
					</div>
				</a>

						<a href="userDashboardPackBookings.php">
				<div class="col-sm-12 menuContainer bottomBorder">
					<span class="fa fa-copy"></span> My Packages
				</div>
				</a>

				
				<div class="col-sm-12 menuContainer bottomBorder active">
					<span class="fa fa-clone"></span> My Train-Tickets
				</div>
				
				
				<a href="userDashboardCancelTicket.php">
				<div class="col-sm-12 menuContainer bottomBorder">
					<span class="fa fa-close"></span> Cancel Ticket
				</div>
				</a>
				

				<a href="userDashboardAccountSettings.php">
					<div class="col-sm-12 menuContainer">
						<span class="fa fa-bar-chart"></span> Account Stats
					</div>
				</a>

			</div>

			<div class="col-sm-7 containerBoxRight text-left">

				<?php
				$user = $_SESSION["username"];
				// Train bookings query
				$trainBookingsSQL = "SELECT COUNT(*) FROM `trainbookings` WHERE username='$user' AND cancelled='no'";
				$trainBookingsQuery = $conn->query($trainBookingsSQL);
				$noOfTrainBookings = $trainBookingsQuery->fetch_array(MYSQLI_NUM);
				?>

				<div class="col-sm-12 tickets">

					<?php if ($noOfTrainBookings[0] > 0): ?>

						<!-------------------------------------------------------------------------------------------------
										
																								TRAIN TICKETS SECTION STARTS
																								
										--------------------------------------------------------------------------------------------------->

					<div class="col-sm-12 ticketTableContainer pullABitLeft">

						<table class="table table-responsive">
							<thead>
								<tr>
									<th class="tableHeaderTags text-center" style="vertical-align: middle;">Id</th>
									<th class="tableHeaderTags text-center" style="vertical-align: middle;">Origin</th>
									<th class="tableHeaderTags text-center" style="vertical-align: middle;">Destination</th>
									<th class="tableHeaderTags text-center" style="vertical-align: middle;">Date</th>
									<th class="tableHeaderTags text-center" style="vertical-align: middle;">Ticket</th>
								</tr>
							</thead>

							<?php
							$trainTicketsSQL = "SELECT * FROM `trainbookings` WHERE username='$user' AND cancelled='no'";
							$trainTicketsQuery = $conn->query($trainTicketsSQL);

							while ($trainTicketsRow = $trainTicketsQuery->fetch_assoc()) {
								?>

							<tr>
								<td class="tableElementTagsNoHover text-center">
									<?php echo $trainTicketsRow["bookingID"]; ?>
								</td>
								<td class="tableElementTagsNoHover text-center">
									<?php echo $trainTicketsRow["origin"]; ?>
								</td>
								<td class="tableElementTagsNoHover text-center">
									<?php echo $trainTicketsRow["destination"]; ?>
								</td>
								<td class="tableElementTagsNoHover text-center">
									<?php echo $trainTicketsRow["date"]; ?>
								</td>
								<td class="text-center">
									<a href="tickets/trainTicket<?php echo $trainTicketsRow["bookingID"]; ?>.html" target="_blank">
										<span class="fa fa-download tableElementTags pullSpan"></span>
									</a>
								</td>
							</tr>

							<?php } ?>

						</table>

					</div>

					<?php else: ?>

					<div class="col-sm-12 ticketTableContainer">

						<div class="noBooking">
							Looks like you haven't booked any train with us yet. This area will list all your train bookings once you
							start booking trains.
						</div>

					</div>

					<?php endif; ?>

					<!-------------------------------------------------------------------------------------------------
										
																								TRAIN TICKETS SECTION ENDS
																								
										--------------------------------------------------------------------------------------------------->

				</div>

			</div> <!-- containerBoxRight -->

			<div class="col-sm-1"></div>

			<div class="col-sm-12 spacer">a</div>
			<div class="col-sm-12 spacer">a</div>

		</div>

	</div> <!-- container-fluid -->

	<?php include("common/footer.php"); ?>

</body>

</html>