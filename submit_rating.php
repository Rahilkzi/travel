<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location:blocked.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageID = $_POST["packageID"];
    $rating = $_POST["rating"];
    $username = $_SESSION["username"];

    $servername = "localhost";
    $dbusername = "root";
    $password = "";
    $dbname = "projectmeteor";

    $conn = new mysqli($servername, $dbusername, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if user has already rated
    $checkSql = "SELECT * FROM package_ratings WHERE username = ? AND packageID = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("si", $username, $packageID);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing rating
        $updateSql = "UPDATE package_ratings SET rating = ? WHERE username = ? AND packageID = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("isi", $rating, $username, $packageID);
        $stmt->execute();
    } else {
        // Insert new rating
        $insertSql = "INSERT INTO package_ratings (packageID, username, rating) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("isi", $packageID, $username, $rating);
        $stmt->execute();
    }

    // Update average rating in packages table
    $avgSql = "UPDATE packages SET 
               packageRating = (SELECT AVG(rating) FROM package_ratings WHERE packageID = ?),
               packageTotalRatings = (SELECT COUNT(*) FROM package_ratings WHERE packageID = ?)
               WHERE packageID = ?";
    $avgStmt = $conn->prepare($avgSql);
    $avgStmt->bind_param("iii", $packageID, $packageID, $packageID);
    $avgStmt->execute();

    $conn->close();
    header("Location: packageDetails.php?packageID=" . $packageID);
    exit();
}
?>