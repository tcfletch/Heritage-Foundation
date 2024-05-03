<?php
// retrieve_main_build_data.php

// Include necessary files and establish database connection
require 'dbheritageconnect.php';

// Check if the recordName parameter is set
if(isset($_GET['recordName'])) {
    $recordName = $_GET['recordName'];

    // Retrieve data from the main_build table for the given recordName
    $query = "SELECT * FROM main_build WHERE record_name = :recordName";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute(['recordName' => $recordName]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Output the retrieved data as JSON
        echo json_encode($data);
    } catch (PDOException $e) {
        // If an exception occurred, return an error message
        echo json_encode(array("error" => "Database error: " . $e->getMessage()));
    }
} else {
    // If recordName parameter is not set, return an error message
    echo json_encode(array("error" => "Record Name parameter is missing"));
}

?>
