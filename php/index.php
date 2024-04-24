<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Tracking System - User</title>
</head>
<body>
    <h1>User Tracking Page</h1>
    
    <?php
      require_once 'C:/xampp/htdocs/OceanStar/php/functions.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_package'])) {
        $user_name = $_POST['user_name'];
        $package_detail =  $_POST['package_detail'];
        $package_status = ''; // Initial status
        $tracking_number = $_POST['tracking_number'];

        $db = initializeDatabase();
        addPackage($db, $user_name, $package_detail, $package_status, $tracking_number);


        
        echo '<h2>Package Added Successfully</h2>';
        echo '<p>Your Tracking Number is: ' . $tracking_number . '</p>';
    }
    ?>

    <form action="index.php" method="post">
        <label for="user_name">Your Name:</label>
        <input type="text" name="user_name" required>
        <label for="package_detail">Package_detail:</label>
        <input type="text" name="package_detail" required>
        <label for="tracking_number">Tracking Number:</label>
        <input type="text" name="tracking_number" maxlength="15" required>
        <button type="submit" name="add_package">Add Package</button>
    </form>

    <hr>
    <h2>Track Your Package</h2>
    <form action="result.php" method="get">
        <label for="tracking_number">Enter Tracking Number:</label>
        <input type="text" name="tracking_number" required>
        <button type="submit">Track Package</button>
    </form>
    
</body>
</html>
