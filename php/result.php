<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Tracking System - Result</title>
</head>
<body>
    <?php
     require_once 'C:/xampp/htdocs/OceanStar/php/functions.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tracking_number'])) {
        $tracking_number = $_GET['tracking_number'];

        $db = initializeDatabase();
        $package = getPackageByTrackingNumber($db, $tracking_number);

        if ($package) {
            echo '<h2>Package Details</h2>';
            echo '<p>Tracking Number: ' . $package['tracking_number'] . '</p>';
            echo '<p>User Name: ' . $package['user_name'] . '</p>';
            echo '<p>Package Detail: ' . $package['package_detail'] . '</p>';
            echo '<p>Status: ' . $package['package_status'] . '</p>';
            echo '<p>Admin Note: ' . $package['admin_note'] . '</p>';
        } else {
            echo '<h2>Package Not Found</h2>';
        }
    }
    ?>

    <a href="tracking.php">Back to Tracking</a>
</body>
</html>
