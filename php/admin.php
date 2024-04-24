<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Tracking System - Admin</title>
</head>
<body>
    <h1>Admin Panel</h1>
    
    <?php
     require_once 'C:/xampp/htdocs/OceanStar/php/functions.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = initializeDatabase();

        if (isset($_POST['update_status'])) {
            $package_id = $_POST['package_id'];
            $new_status = $_POST['new_status'];
            updatePackageStatus($db, $package_id, $new_status);
        }

        if (isset($_POST['update_note'])) {
            $package_id = $_POST['package_id'];
            $admin_note = $_POST['admin_note'];
            updateAdminNote($db, $package_id, $admin_note);
        }

        if (isset($_POST['delete_package'])) {
            $package_id = $_POST['package_id'];
            deletePackage($db, $package_id);
        }
    }
    ?>

    <h2>Package List</h2>
    <?php
     require_once 'C:/xampp/htdocs/OceanStar/php/functions.php';
    $db = initializeDatabase();
    $packages = getAllPackages($db);

    if ($packages) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Tracking Number</th><th>User Name</th><th>Package Detail</th><th>Status</th><th>Admin Note</th><th>Actions</th></tr>';

        foreach ($packages as $package) {
            echo '<tr>';
            echo '<td>' . $package['id'] . '</td>';
            echo '<td>' . $package['tracking_number'] . '</td>';
            echo '<td>' . $package['user_name'] . '</td>';
            echo '<td>' . $package['package_detail'] . '</td>';
            echo '<td>' . $package['package_status'] . '</td>';
            echo '<td>' . $package['admin_note'] . '</td>';
            echo '<td>';
            echo '<form action="admin.php" method="post">';
            echo '<input type="hidden" name="package_id" value="' . $package['id'] . '">';

            // Update status form
            echo '<label for="new_status">New Status:</label>';
            echo '<input type="text" name="new_status" >';
            echo '<button type="submit" name="update_status">Update Status</button>';

            // Update admin note form
            echo '<label for="admin_note">Admin Note:</label>';
            echo '<input type="text" name="admin_note" >';
            echo '<button type="submit" name="update_note">Update Note</button>';

            // Delete package form
            echo '<button type="submit" name="delete_package">Delete Package</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No packages found.</p>';
    }
    ?>

    <a href="index.html">Back to Tracking</a>
</body>
</html>
