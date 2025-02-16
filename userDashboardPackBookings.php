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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>My Package Bookings | tourism_management</title>

    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/userDashboard.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
</head>
<body>

    <div class="container-fluid">
        <div class="col-sm-12 userDashboard text-center">
            <?php include("common/headerDashboardTransparentLoggedIn.php"); ?>

            <div class="col-sm-12">
                <div class="heading">My Package Bookings</div>
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

                <div class="col-sm-12 menuContainer bottomBorder active">
                    <span class="fa fa-copy"></span> My Packages
                </div>

          

                <a href="userDashboardAccountSettings.php">
                    <div class="col-sm-12 menuContainer noBottomBorder">
                        <span class="fa fa-bar-chart"></span> Account Stats
                    </div>
                </a>
            </div>

            <div class="col-sm-7 containerBoxRightHotel text-left">
                <div class="col-sm-12 tickets">
                    <?php
                    require 'db_connection.php'; // Ensure you have a proper database connection file.
                    $user = $_SESSION["username"];

                    // Count number of package bookings for the user
                    $packageBookingsSQL = "SELECT COUNT(*) FROM `packagebookings` WHERE Username='$user' AND cancelled='no'";
                    $packageBookingsQuery = $conn->query($packageBookingsSQL);
                    $noOfPackageBookings = $packageBookingsQuery->fetch_array(MYSQLI_NUM);

                    if ($noOfPackageBookings[0] > 0): ?>

                          <div class="col-sm-12 ticketTableContainer pullABitLeft" id="packageBookingsWrapper">
                              <table class="table table-responsive">
                                  <thead>
                                      <tr>
                                          <th class="tableHeaderTags text-center">Id</th>
                                          <th class="tableHeaderTags text-center">Package</th>
                                          <th class="tableHeaderTags text-center">Date</th>
                                          <th class="tableHeaderTags text-center">Receipt</th>
                                          <th class="tableHeaderTags text-center">Cancel</th>
                                      </tr>
                                  </thead>

                                  <?php
                                  // Fetch user's package bookings
                                  $packageBooksSQL = "SELECT * FROM `packagebookings` WHERE username='$user' AND cancelled='no'";
                                  $packageBooksQuery = $conn->query($packageBooksSQL);

                                  while ($packageBooksRow = $packageBooksQuery->fetch_assoc()) { ?>
                                        <tr>
                                            <td class="tableElementTagsNoHover text-center"><?php echo $packageBooksRow["bookingID"]; ?></td>
                                            <td class="tableElementTagsNoHover text-center"><?php echo $packageBooksRow["packageName"]; ?></td>
                                            <td class="tableElementTagsNoHover text-center"><?php echo $packageBooksRow["date"]; ?></td>
                                            <td class="text-center">
                                                <a href="receipts/package_receipt<?php echo $packageBooksRow["bookingID"]; ?>.html" target="_blank">
                                                    <span class="fa fa-download tableElementTags pullSpan"></span>
                                                </a>
                                            </td>
                                            <td class="tableElementTags text-center">
                                                <span class="fa fa-remove tableElementTags pullTop cancelBooking"></span>
                                            </td>
                                        </tr>
                                  <?php } ?>
                              </table>
                              
                          </div>

                    <?php else: ?>
                          <div class="col-sm-12 ticketTableContainer" id="packageTicketsWrapper">
                              <div class="noBooking">
                                  Looks like you haven't booked any packages with us yet.
                              </div>
                          </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-sm-1"></div>
        </div>
    </div> <!-- container-fluid -->

    <?php include("common/footer.php"); ?>

</body>
</html>
