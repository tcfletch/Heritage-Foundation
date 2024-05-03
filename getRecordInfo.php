<?php
require 'dbheritageconnect.php'; // Include your database connection file

if (isset($_GET['recordName'])) {
    $recordName = $_GET['recordName'];

    // Prepare the SQL query
    $query = "SELECT buildingName, townCity, village, dateUpdate, taxMap, Address, streetNumber, streetName, currentCondition, yearCondition, presentOwner, otherOwners, historicDistrict, streetSide, architecturalStyle, notes, hamlet FROM main_build WHERE recordName = ?";

    // Prepare and execute the statement
    $stmt = $pdo->prepare($query);
    $stmt->execute([$recordName]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Output the result as JSON
    echo json_encode($result);
} else {
    // Handle if recordName parameter is not provided
}
?>
