<?php
require 'dbheritageconnect.php';

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$updateValues = $data['updateValues'];


addProperty($updateValues);

function addProperty($updateValues) {
    global $pdo;

    $columnMappings = array(
        'record_name' => 'record_name',
        'Building_Name' => 'Building_Name',
        'Building_Town_City' => 'Building_Town_City',
        'Building_Village' => 'Building_Village',
        'last_updated' => 'last_updated',
        'Current_Condition' => 'Current_Condition',
        'Present_owner_last_name' => 'Present_owner_last_name',
        'Other_known_owners' => 'Other_known_owners',
        'Historic_District' => 'Historic_District',
        'side_of_street' => 'side_of_street',
        'Architectural_Style' => 'Architectural_Style',
        'Notes' => 'Notes',
        'Hamlet' => 'Hamlet'
    );


    $updateValuesDB = array();
    foreach ($updateValues as $key => $value) {
        if (isset($columnMappings[$key])) {
            $updateValuesDB[$columnMappings[$key]] = $value;
        }
    }

    $columns = array_keys($updateValuesDB);
    $values = array_values($updateValuesDB);
    $placeholders = array_fill(0, count($columns), '?');


    // Construct the query
    $columnsStr = implode(", ", $columns);
    $placeholdersStr = implode(", ", $placeholders);
    $query = "INSERT INTO main_build ($columnsStr) VALUES ($placeholdersStr)";

    // Prepare and execute the query
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($values);
        echo "Property Successfully Added to Database";
    } catch (PDOException $except) {
        echo "Error Adding Property to Database: " . $except->getMessage();
    }
}

?>
