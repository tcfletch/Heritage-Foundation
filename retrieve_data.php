<?php
require 'dbheritageconnect.php';

// Retrieve data sent via AJAX
$data = json_decode(file_get_contents("php://input"), true);
$recordName = $data['recordName'];

// Call the function to retrieve data
$recordData = retrieveData($recordName);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($recordData);

// Function to retrieve data based on record name
function retrieveData($recordName) {
    global $pdo;

    $query = "SELECT * FROM main_build WHERE record_name = ?";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute([$recordName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $except) {
        // Handle exceptions if necessary
        return false;
    }
}
?>
