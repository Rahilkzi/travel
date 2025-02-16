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
  <title>Package Details | tourism_management</title>

  <link href="css/main.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700"
    rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>
  <?php include("common/headerLoggedIn.php"); ?>

  <?php
  $packageID = $_GET["packageID"];
  ?>

  <div class="spacer">a</div>
  <div class="spacer">a</div>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "projectmeteor";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM packages WHERE packageID='$packageID'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  ?>

  <div class="col-sm-1"></div>

  <div class="col-sm-10 packageDetails">
    <?php
    // Get the row count
    $rowcount = $result->num_rows;
    
    if ($rowcount > 0) {
        // Handling multiple images stored as comma-separated values
        $imageArray = explode(",", $row["packageImages"]);
        $packageImage = isset($imageArray[0]) ? trim($imageArray[0]) : "";
    
        // If the stored image path does not include "uploads/", add it
        if (!empty($packageImage) && !file_exists($packageImage)) {
            $packageImage = "management/" . $packageImage;
        }
        ?>
        
        <div class="col-sm-12 listItem">
            <div class="col-sm-8 leftBox">
                <div class="col-sm-12 imageContainer">
                    <img src="<?php echo htmlspecialchars($packageImage); ?>" alt="Image not found" />
                </div>
            </div>
            
            <div class="col-sm-4 rightBox borderLeft">
                <div class="packageName col-sm-12 text-center noMargin">
                    <?php echo $row["packageName"]; ?>
                </div>
                
                <div class="location col-sm-12 text-center">
                    <span class="fa fa-map-marker"></span> <?php echo $row["packageDestination"]; ?>
                </div>

                <div class="col-sm-12 text-center">
                    <div class="col-sm-12 rating noMargin">
                        <?php echo $row["packageRating"] . " (" . $row["packageTotalRatings"] . " )"; ?>
                    </div>
                    
                    <div class="col-sm-12 ratingText noMargin">
                        <?php
                        $rating=$row["packageRating"];
                        if($rating>=4): ?>
                            Excellent
                        <?php
                        elseif($rating>=3 and $rating<4): ?>
                            Average
                        <?php
                        elseif($rating<3): ?>
                            Bad
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-sm-7 text-center">
                    <div class="col-sm-12 starContainer">
                        <?php
                        $noOfStars=$row["packageRating"];;
                        for($i=0; $i<$noOfStars; $i++) {?>
                            <i class="fa fa-star"></i>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm-12 durationContainer  text-center">
                    <span  style="    font-size: 20px; top: 25px; right: 8px; position: relative;" class="fa fa-clock-o"> Duration</span>
                    <div class="col-sm-12 checkInOut text-center">
                        <div class="col-sm-6 checkIn">
                            <div class="col-sm-12 time">
                                <?php echo $row["packageDays"] . " Days " ?>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 checkOut">
                            <div class="col-sm-12 time">
                                <?php echo  $row["packageNights"] . " Nights";  ?>
                            </div>
                        </div>
                    </div> <!-- checkInOut -->
                </div>

                <div class="col-sm-10 amenities text-center">
                    <ul>
                        <li><strong>Accommodation:</strong> <?php echo $row["packageAccommodation"]; ?></li>
                        <li><strong>Transportation:</strong> <?php echo $row["packageTransportation"]; ?></li>
                        <li><strong>Meals:</strong> <?php echo $row["packageMeals"]; ?></li>
                        <li><strong>Activities:</strong> <?php echo $row["packageActivities"]; ?></li>
                    </ul>
                </div>

                <div class="col-sm-12 priceContainer text-center">
                    ₹ <?php echo ($row["packageOffer"] ? $row["packageDiscountPrice"] : $row["packagePrice"]); ?>
                </div>

                <!-- Add Rating Form -->
                <div class="col-sm-12 ratingForm text-center">
                    <form action="submit_rating.php" method="POST">
                        <div class="rating-stars">
                            <input type="radio" name="rating" value="5" id="star5"><label for="star5"></label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4"></label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3"></label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2"></label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1"></label>
                        </div>
                        <input type="hidden" name="packageID" value="<?php echo $packageID; ?>">
                        <input type="submit" class="rateNow" value="Submit Rating">
                    </form>
                </div>

                <form action="booking.php" method="POST">
                    <div class="col-sm-12 text-center">
                        <input type="submit" class="bookNow" value="Book Now" />
                    </div>
                    <input type="hidden" name="modeHidden" value="package" />
                    <input type="hidden" name="packageIDHidden" value="<?php echo $packageID; ?>" />
                </form>
            </div>

            <div class="col-sm-12 hotelDesc">
                <?php echo $row["packageDescription"]; ?>
            </div>
        </div>
    <?php } ?>
  </div>

  <div class="col-sm-1"></div>
  <div class="col-sm-12 spacerLarge">.</div>
  <?php include("common/footer.php"); ?>
</body>

</html>