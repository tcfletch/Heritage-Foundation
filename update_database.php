<?php
require 'dbheritageconnect.php';

// Retrieve data sent via AJAX
$data = json_decode(file_get_contents("php://input"), true);
$recordName = $data['recordName'];
$updateValues = $data['updateValues'];

// Call the updateDatabase function
updateDatabase($recordName, $updateValues);

// Function to update database
function updateDatabase($recordName, $updateValues) {
    global $pdo;

    $setFields = [];
    $setValues = [];

    foreach ($updateValues as $key => $value) {
        if (!empty($value)) {
            // Adjust the field name to match the column name in the database
            // Enclose column names with spaces in backticks
            $fieldName = str_replace('_', ' ', ucwords($key, '_'));
            $fieldName = str_replace(' ', '_', $fieldName); // Replace spaces with underscores
            
            // Adjust column name to "side_of_street" if the key is "street_side"
            if ($key === 'street_side') {
                $fieldName = 'side_of_street';
            }

            // Adjust the column names in the SET part of the query
            $setFields[] = "`$fieldName` = ?";
            $setValues[] = $value;
        }
    }

    // Construct the SET part of the query
    $setFieldsStr = implode(", ", $setFields);

    // Update the query to use explicitly specified column names
    // Adjust the table name and WHERE clause as necessary
    $query = "UPDATE main_build SET $setFieldsStr WHERE `record_name` = ?";

    // Add the record name as the last bound value
    $setValues[] = $recordName;

    $stmt = $pdo->prepare($query);

    try {
        // Execute the prepared statement with the bound values
        $stmt->execute($setValues);
        echo "Database Successfully Updated";
    } catch (PDOException $except) {
        echo "Error Updating Database: " . $except->getMessage();
    }
}

?> 