<?php
require '../db_connection.php'; // Ensure a proper database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["packageID"])) {
  $packageID = intval($_POST["packageID"]); // Sanitize input

  // Get image path before deleting
  $stmt = $conn->prepare("SELECT packageImages FROM packages WHERE packageID = ?");
  $stmt->bind_param("i", $packageID);
  $stmt->execute();
  $stmt->bind_result($packageImages);
  $stmt->fetch();
  $stmt->close();

  // Delete image files
  if (!empty($packageImages)) {
    $imageArray = explode(",", $packageImages);
    foreach ($imageArray as $image) {
      $image = trim($image);
      if (file_exists($image)) {
        unlink($image); // Delete image file
      }
    }
  }

  // Delete package from database
  $stmt = $conn->prepare("DELETE FROM packages WHERE packageID = ?");
  $stmt->bind_param("i", $packageID);

  if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // header("Location: package_list.php?success=1"); // Redirect after deletion
    header("Location: packages_add.php"); // Redirect after deletion

    exit();
  } else {
    echo "Error deleting package.";
  }
}
?>
