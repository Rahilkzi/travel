<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location:blocked.php");
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}

// Start output buffering
ob_start();

require 'db_connection.php'; // Ensure you have a proper database connection file.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Package Receipt | tourism_management</title>
    
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="spacer">a</div>
    
    <?php
    date_default_timezone_set("Asia/Kolkata");
    $date = date('l jS \of F Y \a\t h:i:s A');
    $packageID = $_POST["packageIDHidden"];
    $fare = $_POST["fareHidden"];

 

    $sql = "SELECT * FROM packages WHERE packageID='$packageID'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        die("No package found for ID: " . $packageID);
    }

    $row = $result->fetch_assoc();
    ?>
    
    <div class="col-sm-12 generateReceipt">
        <div class="commonHeader">
            <div class="col-sm-12 headingOne">Package Booking Receipt</div>
            <div class="col-sm-12 dateTime">Generated: <?php echo $date; ?></div>
        </div>
        
        <div class="col-sm-12 boxCenter">
            <div class="col-sm-3 text-center"><strong>Package Name</strong><br><?php echo $row["packageName"]; ?></div>
            <div class="col-sm-3 text-center"><strong>Destination</strong><br><?php echo $row["packageDestination"]; ?></div>
            <div class="col-sm-2 text-center"><strong>Days/Nights</strong><br><?php echo $row["packageDays"] . 'D / ' . $row["packageNights"] . 'N'; ?></div>
            <div class="col-sm-2 text-center"><strong>Price</strong><br>₹ <?php echo $row["packagePrice"]; ?></div>
        </div>
        
        <div class="col-sm-12 spacer"></div>
        
        <div class="col-sm-12 subHeading">Payment Details</div>
        <div class="col-sm-12 boxCenter">
            <div class="col-sm-4 text-center"><strong>Amount Paid</strong><br>₹ <?php echo $fare; ?></div>
            <div class="col-sm-4 text-center"><strong>Payment Mode</strong><br>Card Payment</div>
        </div>
    </div>
    
</body>
</html>

<?php
$user = $_SESSION["username"];
$dateFormatted = date("d-m-Y");
$packageName = $row["packageName"];
$bookingSQL = "INSERT INTO `packagebookings`(packageName, date, username, cancelled) VALUES('$packageName', '$dateFormatted', '$user', 'no')";
$conn->query($bookingSQL);

$bookingIDSQL = "SELECT * FROM `packagebookings` ORDER BY `bookingID` DESC LIMIT 1";
$bookingIDQuery = $conn->query($bookingIDSQL);
$bookingIDGet = $bookingIDQuery->fetch_array(MYSQLI_NUM);
$currentBookingID = $bookingIDGet[0];

// Save the receipt as an HTML file
file_put_contents("receipts/package_receipt_$currentBookingID.html", ob_get_contents());
?>
