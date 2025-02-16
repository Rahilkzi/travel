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
  <title>Package Search | tourism_management</title>

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
  require 'db_connection.php'; // Ensures a proper database connection.
  
  $city = isset($_GET["city"]) ? trim($_GET["city"]) : "";
  $cityEscaped = mysqli_real_escape_string($conn, $city);
  ?>

  <div class="spacer">a</div>

  <div class="searchPackages">
    <div class="query">Packages <?php echo $city ? "in " . htmlspecialchars($city) : ""; ?></div>
  </div>

  <?php
  // Constructing the query
  $sql = "SELECT * FROM packages";
  if (!empty($cityEscaped)) {
    $sql .= " WHERE packageDestination='$cityEscaped'";
  }

  $result = $conn->query($sql);
  $rowcount = $result ? $result->num_rows : 0;
  ?>



  <div class="col-sm-12 searchPackages">
    <?php
    if ($rowcount > 0) {
      while ($row = $result->fetch_assoc()) {
           // Handling multiple images stored as comma-separated values
           $imageArray = explode(",", $row["packageImages"]);
           $packageImage = isset($imageArray[0]) ? trim($imageArray[0]) : "";
    
           // If the stored image path does not include "uploads/", add it
        if (!empty($packageImage) && !file_exists($packageImage)) {
          $packageImage =  "management/" . $packageImage;
        }

  

        
        ?>
        <div class="col-sm-4 text-center">
          <div class="col-sm-12 listItem">
            <!-- <div class="col-sm-12 imageContainer text-center">
              <img src="<?php echo htmlspecialchars($packageImage); ?>"
                alt="<?php echo htmlspecialchars($row["packageName"]); ?>">
            </div> -->
            <div class="col-sm-12 imageContainer text-center">
    
        <img src="<?php echo htmlspecialchars($packageImage); ?>" 
             alt="<?php echo htmlspecialchars($row["packageName"]); ?>" 
             style="width:100%; height:auto; max-height:200px;">
            </div>


            <div class="col-sm-12 packageName"> <?php echo htmlspecialchars($row["packageName"]); ?> </div>
            <div class="col-sm-12 durationContainer"> <?php echo $row["packageDays"] . " days"; ?> </div>
            <div class="col-sm-12 priceContainer"> ₹ <?php echo number_format($row["packagePrice"], 2); ?> </div>

            <div class="col-sm-12 view">
              <a href="packageDetails.php?packageID=<?php echo $row["packageID"]; ?>">
                <input type="button" class="viewDetails" name="viewDetails" value="View Package Details" />
              </a>
            </div>

          </div>
   

        </div>

        <?php
      }
    } else {
      ?>
      <div class="col-sm-12 searchPackages">
        <div class="noPackages">No packages found.</div>
      </div>
      <?php
    }
    $conn->close();
    ?>


  </div>


  <div class="spacerLarge">.</div>

  <?php include("common/footer.php"); ?>
</body>

</html>