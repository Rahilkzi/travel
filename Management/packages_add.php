<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Panel | Travel Packages </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            background: linear-gradient(45deg, #ff8080, #ffffb3);
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 100%;
        }
    </style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectmeteor";

$packageID = "";
$packageName = "";
$packageDescription = "";
$packageDestination = "";
$packageDays = "";
$packageNights = "";
$packageAccommodation = "";
$packageTransportation = "";
$packageMeals = "";
$packageActivities = "";
$packagePrice = "";
$packageDiscountPrice = "";
$packageOffer = "";
$packageRating = "";
$packageTotalRatings = "";
$packageImages = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (MySQLi_Sql_Exception $ex) {
    echo ("Connection Error");
}
function getData()
{
    $data = array();
    $data[1] = $_POST['packageName'] ?? '';
    $data[2] = $_POST['packageDescription'] ?? '';
    $data[3] = $_POST['packageDestination'] ?? '';
    $data[4] = $_POST['packageDays'] ?? '';
    $data[5] = $_POST['packageNights'] ?? '';
    $data[6] = $_POST['packageAccommodation'] ?? '';
    $data[7] = $_POST['packageTransportation'] ?? '';
    $data[8] = $_POST['packageMeals'] ?? '';
    $data[9] = $_POST['packageActivities'] ?? '';
    $data[10] = $_POST['packagePrice'] ?? '';
    $data[11] = $_POST['packageDiscountPrice'] ?? '';
    $data[12] = $_POST['packageOffer'] ?? '';
    $data[13] = $_POST['packageRating'] ?? 0;
    $data[14] = $_POST['packageTotalRatings'] ?? 0;
    return $data;
}


if (isset($_POST['insert'])) {
    $info = getData();


    // Handle Image Upload
    $targetDir = "management/uploads/";
    $targetFile = $targetDir . basename($_FILES["packageImage"]["name"]);

    if (isset($_FILES["packageImage"]) && $_FILES["packageImage"]["error"] == 0) {
        $targetDir = "uploads/";

        // Ensure uploads directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES["packageImage"]["name"]);

        if (move_uploaded_file($_FILES["packageImage"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            $imagePath = "";
            echo "Error: Failed to upload image.";
        }
    } else {
        $imagePath = "";
    }


    $insert_query = "INSERT INTO `packages`(`packageName`, `packageDescription`, `packageDestination`, `packageDays`, `packageNights`, `packageAccommodation`, `packageTransportation`, `packageMeals`, `packageActivities`, `packagePrice`, `packageDiscountPrice`, `packageOffer`,  `packageImages`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]','$info[8]','$info[9]','$info[10]','$info[11]','$info[12]','$imagePath')";
    try {
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            if (mysqli_affected_rows($conn) > 0) {
                echo ("Travel Package added successfully");
            } else {
                echo ("Failed to add Travel Package");
            }
        }
    } catch (Exception $ex) {
        echo ("Error inserting: " . $ex->getMessage());
    }
}
?>

<body>
    <div class="container-fliud">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1 class="navbar-brand"> Tourism Management System</h1>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav" style="float:right">
                        <li><a href="Home.php">HOME</a></li>
                        <li><a href="users_add.php">USERS</a></li>
                        <li><a href="hotels_add.php">ADD HOTELS</a></li>
                        <li><a href="hotelbookings_view.php">HOTEL BOOKINGS</a></li>
                        <li><a href="flights_add.php">ADD FLIGHTS</a></li>
                        <li><a href="flightbookings_view.php">FLIGHT BOOKINGS</a></li>
                        <li><a href="trains_add.php">ADD TRAINS</a></li>
                        <li><a href="trainbookings_view.php">TRAIN BOOKINGS</a></li>
                        <h3><a href="adminLogout.php">LOGOUT</a></h3>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row mx-5 my-5" style="display: flex; justify-content: center;">
            <div class="col-lg-6">
                <form method="post" action="" enctype="multipart/form-data">
                    <h2>Add Travel Package</h2>

                    <div class="form-group">
                        <label>Package Image</label>
                        <input type="file" name="packageImage" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" name="packageName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="packageDescription" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Destination</label>
                        <input type="text" name="packageDestination" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Days</label>
                        <input type="number" name="packageDays" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nights</label>
                        <input type="number" name="packageNights" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Accommodation</label>
                        <input type="text" name="packageAccommodation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Transportation</label>
                        <input type="text" name="packageTransportation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Meals</label>
                        <input type="text" name="packageMeals" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Activities</label>
                        <input type="text" name="packageActivities" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="packagePrice" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Discount Price</label>
                        <input type="number" name="packageDiscountPrice" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Offer Available?</label>
                        <select name="packageOffer" class="form-control">
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success btn-block" name="insert" value="Add Package">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <h1 class="text-danger text-center" style="font-weight:bold">Package DETAILS</h1>
            <hr>
            <br><br>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "projectmeteor";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Corrected SQL Query
            $sql = "SELECT packageID,packageName, packageDescription, packageDestination, packageDays, packageNights, 
                   packageAccommodation, packageTransportation, packageMeals, packageActivities, 
                   packagePrice, packageDiscountPrice, packageOffer, packageImages 
            FROM packages";

            $result = $conn->query($sql);

            // Start table
            echo "<table class='table table-striped table-bordered table-hover' 
               style='border: 4px solid black; text-align: center;'>
            <tr style='font-size:20px; background:black; color:white;'>
                <th>Package Name</th>
                <th>Description</th>
                <th>Destination</th>
                <th>Days</th>
                <th>Nights</th>
                <th>Accommodation</th>
                <th>Transportation</th>
                <th>Meals</th>
                <th>Activities</th>
                <th>Price (₹)</th>
                <th>Discount Price (₹)</th>
                <th>Offer</th>
                <th>Image</th>
                <th>Actions</th> <!-- New column for Delete button -->
            </tr>";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['packageName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageDescription']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageDestination']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageDays']) . " days</td>";
                    echo "<td>" . htmlspecialchars($row['packageNights']) . " nights</td>";
                    echo "<td>" . htmlspecialchars($row['packageAccommodation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageTransportation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageMeals']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['packageActivities']) . "</td>";
                    echo "<td>₹ " . number_format($row['packagePrice'], 2) . "</td>";
                    echo "<td>₹ " . number_format($row['packageDiscountPrice'], 2) . "</td>";
                    echo "<td>" . ($row['packageOffer'] ? "Yes" : "No") . "</td>";
                    

                    // Image Handling
                    $imageArray = explode(",", $row["packageImages"]);
                    $packageImage = isset($imageArray[0]) ? trim($imageArray[0]) : "";

                    if (!empty($packageImage) && file_exists($packageImage)) {
                        echo "<td><img src='" . htmlspecialchars($packageImage) . "' 
                             style='width:100px; height:auto;'></td>";
                    } else {
                        echo "<td>No Image</td>";
                    }

                    // Delete Button
                    echo "<td>
                            <form method='post' action='delete_package.php' onsubmit='return confirm(\"Are you sure?\")'>
                                <input type='hidden' name='packageID' value='" . $row['packageID'] . "'>
                                <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                        </td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No packages found.</td></tr>";
            }

            echo "</table>";

            $conn->close();
            ?>
        </div>

    </div>
</body>

</html>