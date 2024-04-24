<?php




// Function to initialize the database
function initializeDatabase() {
    $host = 'localhost';
    $dbname = 'oceanstar_db';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec('
            CREATE TABLE IF NOT EXISTS packages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                tracking_number VARCHAR(8) UNIQUE,
                user_name VARCHAR(255),
                package_detail VARCHAR(255),
                package_status VARCHAR(255),
                admin_note TEXT
            )
        ');
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

    return $db;
}

// Function to add a new package
function addPackage($db, $user_name, $package_detail, $package_status, $tracking_number) {
    $stmt = $db->prepare('INSERT INTO packages (tracking_number, user_name, package_detail, package_status) VALUES (:tracking_number, :user_name, :package_detail, :package_status)');
    $stmt->bindParam(':tracking_number', $tracking_number);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':package_detail', $package_detail);
    $stmt->bindParam(':package_status', $package_status);
    $stmt->execute();
}

// Function to get a package by tracking number
function getPackageByTrackingNumber($db, $tracking_number) {
    $stmt = $db->prepare('SELECT * FROM packages WHERE tracking_number = :tracking_number');
    $stmt->bindParam(':tracking_number', $tracking_number);
    $stmt->execute();
    return $stmt->fetch();
}

// Function to get all packages
function getAllPackages($db) {
    $stmt = $db->query('SELECT * FROM packages');
    return $stmt->fetchAll();
}

// Function to update package status
function updatePackageStatus($db, $package_id, $new_status) {
    $stmt = $db->prepare('UPDATE packages SET package_status = :new_status WHERE id = :package_id');
    $stmt->bindParam(':new_status', $new_status);
    $stmt->bindParam(':package_id', $package_id);
    $stmt->execute();
}

// Function to update admin note
function updateAdminNote($db, $package_id, $admin_note) {
    $stmt = $db->prepare('UPDATE packages SET admin_note = :admin_note WHERE id = :package_id');
    $stmt->bindParam(':admin_note', $admin_note);
    $stmt->bindParam(':package_id', $package_id);
    $stmt->execute();
}

// Function to delete a package
function deletePackage($db, $package_id) {
    $stmt = $db->prepare('DELETE FROM packages WHERE id = :package_id');
    $stmt->bindParam(':package_id', $package_id);
    $stmt->execute();
}
?>
