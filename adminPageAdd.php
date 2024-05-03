<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Suggestions</title>
<style>
  body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 2px solid #000000;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #9b9c84;
    }
    tr:nth-child(even) {
        background-color: #a6a6a6;
    }
  	tr:nth-child(odd) {
    	background-color: #bcbda2;  
    }
    tr:hover {
        background-color: #ddd;
    }
    button {
        padding: 8px 12px;
        background-color: #303030;
        border: none;
        color: white;
        padding: 15px;
        text-align: center;
        text-decoration: none;
        display: block;
        border-radius: 5px;
    }
    button:hover {
        background-color: #45a049;
    }
    /* Popup container style */
    .popup-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #bcbda2;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 70%;
        height: 85vh; /* 85% of the viewport height */
        overflow: hidden;
        z-index: 1000; /* Ensure it's above other content */
        padding: 10px;
    }
    .popup-section {
        float: left;
        width: 100%;
        height: 100%;
        overflow-y: auto;
    }
    .popup-section h3 {
        margin-top: 0;
    }
    .popup-section input[type="text"] {
        width: calc(100% - 20px);
        padding: 5px;
        margin: 5px 10px;
    }
    .popup-close-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
        padding: 5px 10px;
        background-color: #303030;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
  	#confirmUpdatesButton {
      position: absolute;
        bottom: 10px;
        left: 10px;
        padding: 8px 12px;
        background-color: #303030;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
  }
</style>
</head>
<body>
<?php
require 'dbheritageconnect.php';

function retrieveData($tableName, $columns = "*", $conditions = array()) {
    // Call upon connection
    global $pdo;

    $query = "SELECT $columns FROM $tableName";

    if (!empty($conditions)) {
        $query .= " WHERE ";
        $conditionsArr = array();
        foreach ($conditions as $column => $value) {
            $conditionsArr[] = "$column = ?";
        }
        $query .= implode(" AND ", $conditionsArr);
    }

    $stmt = $pdo->prepare($query);

    try {
        // Execute the query
        $stmt->execute(array_values($conditions));

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the fetched data
        return $results;
    } catch (PDOException $except) {
        // Handle any exceptions
        echo "<script>alert('Error retrieving data: " . addslashes($except->getMessage()) . "');</script>";
        return false;
    }
}

$tableName = "suggestions";
$columns = "buildingName, recordName, townCity, village, dateUpdate, currentCondition, yearCondition, presentOwner, otherOwners, historicDistrict, streetSide, architecturalStyle, notes, hamlet";

$data = retrieveData($tableName, $columns);

if ($data) {
    // Start HTML output
    echo '<table border="1" cellpadding="5">';

// Table headers
echo '<tr>';
echo '<th>Record Name</th>';
foreach (explode(', ', $columns) as $column) {
    // Convert column names to more natural sounding counterparts with spaces
    $naturalLabel = preg_replace('/(?<!\ )[A-Z]/', ' $0', $column); // Add space before capital letters
    $naturalLabel = ucwords(str_replace('_', ' ', $naturalLabel));
    echo "<th>$naturalLabel</th>";
}
echo '<th>Action</th>'; // Additional column for action button
echo '</tr>';





    // Loop through each row of data
    foreach ($data as $row) {
        // Start a new row
        echo '<tr>';

        // Bolded record name to the far left
        echo "<td><strong>{$row['recordName']}</strong></td>";

        // Loop through each column in the row
        foreach ($row as $value) {
            // Display the value with added spacing
            echo "<td style='padding: 5px;'>$value</td>";
        }

        // Action button to open a popup container and pass record data as parameters
        echo "<td><button onclick=\"openPopupContainer(
            '{$row['recordName']}',
            '{$row['buildingName']}',
            '{$row['townCity']}',
            '{$row['village']}',
            '{$row['dateUpdate']}',
            '{$row['currentCondition']}',
            '{$row['yearCondition']}',
            '{$row['presentOwner']}',
            '{$row['otherOwners']}',
            '{$row['historicDistrict']}',
            '{$row['streetSide']}',
            '{$row['architecturalStyle']}',
            '{$row['notes']}',
            '{$row['hamlet']}'
        )\">Add Property</button></td>";

        // End the row
        echo '</tr>';
    }

    // End the table
    echo '</table>';
} else {
    // Data retrieval failed, handle accordingly
}
?>

<!-- Popup container -->
<div id="popupContainer" class="popup-container">
    <!-- Suggested section -->
    <div class="popup-section">
        <!-- Content goes here -->
        <h3>Suggested Information</h3>
        <ul>
            <li><strong>Record Name:</strong> <input type="text" name="recordName" id="recordNameInput"></li>
            <li><strong>Building Name:</strong> <input type="text" name="buildingName"></li>
            <li><strong>Town/City:</strong> <input type="text" name="townCity"></li>
            <li><strong>Village:</strong> <input type="text" name="village"></li>
            <li><strong>Date Update:</strong> <input type="text" name="dateUpdate"></li>
            <li><strong>Current Condition:</strong> <input type="text" name="currentCondition"></li>
            <li><strong>Year Condition:</strong> <input type="text" name="yearCondition"></li>
            <li><strong>Present Owner:</strong> <input type="text" name="presentOwner"></li>
            <li><strong>Other Owners:</strong> <input type="text" name="otherOwners"></li>
            <li><strong>Historic District:</strong> <input type="text" name="historicDistrict"></li>
            <li><strong>Street Side:</strong> <input type="text" name="streetSide"></li>
            <li><strong>Architectural Style:</strong> <input type="text" name="architecturalStyle"></li>
            <li><strong>Notes:</strong> <input type="text" name="notes"></li>
            <li><strong>Hamlet:</strong> <input type="text" name="hamlet"></li>
        </ul>
    </div>
    <!-- Confirm Updates button -->
    <button id="confirmUpdatesButton">Add Property</button>

    <!-- Close button -->
    <button class="popup-close-button" onclick="closePopupContainer()">Close</button>
</div>

<script>
// Function to open the popup container with data
function openPopupContainer(record_name, Building_Name, Building_Town_City, Building_Village, last_updated, Current_Condition, Present_owner_last_name, Other_known_owners, Historic_District, side_of_street, Architectural_Style, Notes, Hamlet) {
    // Set input field values, providing defaults for empty fields
    document.querySelector("#popupContainer [name='recordName']").value = record_name || '';
    document.querySelector("#popupContainer [name='buildingName']").value = Building_Name || '';
    document.querySelector("#popupContainer [name='townCity']").value = Building_Town_City || '';
    document.querySelector("#popupContainer [name='village']").value = Building_Village || '';
    document.querySelector("#popupContainer [name='dateUpdate']").value = last_updated || '';
    document.querySelector("#popupContainer [name='currentCondition']").value = Current_Condition || '';
    document.querySelector("#popupContainer [name='presentOwner']").value = Present_owner_last_name || '';
    document.querySelector("#popupContainer [name='otherOwners']").value = Other_known_owners || '';
    document.querySelector("#popupContainer [name='historicDistrict']").value = Historic_District || '';
    document.querySelector("#popupContainer [name='streetSide']").value = side_of_street || '';
    document.querySelector("#popupContainer [name='architecturalStyle']").value = Architectural_Style || '';
    document.querySelector("#popupContainer [name='notes']").value = Notes || '';
    document.querySelector("#popupContainer [name='hamlet']").value = Hamlet || '';


    // Display the popup container
    document.getElementById("popupContainer").style.display = "block";
}

// Function to add property
function addProperty() {

    // Retrieve other input values
  	var record_name = document.querySelector("#popupContainer [name='recordName']").value.trim();
    var Building_Name = document.querySelector("#popupContainer [name='buildingName']").value.trim();
    var Building_Town_City = document.querySelector("#popupContainer [name='townCity']").value.trim();
    var Building_Village = document.querySelector("#popupContainer [name='village']").value.trim();
    var last_updated = document.querySelector("#popupContainer [name='dateUpdate']").value.trim();
    var Current_Condition = document.querySelector("#popupContainer [name='currentCondition']").value.trim();
    var Present_owner_last_name = document.querySelector("#popupContainer [name='presentOwner']").value.trim();
    var Other_known_owners = document.querySelector("#popupContainer [name='otherOwners']").value.trim();
    var Historic_District = document.querySelector("#popupContainer [name='historicDistrict']").value.trim();
    var side_of_street = document.querySelector("#popupContainer [name='streetSide']").value.trim();
    var Architectural_Style = document.querySelector("#popupContainer [name='architecturalStyle']").value.trim();
    var Notes = document.querySelector("#popupContainer [name='notes']").value.trim();
    var Hamlet = document.querySelector("#popupContainer [name='hamlet']").value.trim();

    // Log the data just before sending the AJAX request
    console.log("Data being sent via AJAX:");
    console.log("Record Name:", record_name);
    console.log("Building Name:", Building_Name);
    console.log("Town/City:", Building_Town_City);
    console.log("Village:", Building_Village);
    console.log("Date Update:", last_updated);
    console.log("Current Condition:", Current_Condition);
    console.log("Present Owner:", Present_owner_last_name);
    console.log("Other Owners:", Other_known_owners);
    console.log("Historic District:", Historic_District);
    console.log("Street Side:", side_of_street);
    console.log("Architectural Style:", Architectural_Style);
    console.log("Notes:", Notes);
    console.log("Hamlet:", Hamlet);

    // Construct the data object
    var data = {
    updateValues: {
      	record_name: record_name,
        Building_Name: Building_Name,
        Building_Town_City: Building_Town_City,
        Building_Village: Building_Village,
        last_updated: last_updated,
        Current_Condition: Current_Condition,
        Present_owner_last_name: Present_owner_last_name,
        Other_known_owners: Other_known_owners,
        Historic_District: Historic_District,
        side_of_street: side_of_street,
        Architectural_Style: Architectural_Style,
        Notes: Notes,
        Hamlet: Hamlet
    }
};

    // Log the constructed data object
    console.log("Data object:", data);

    // Send data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_property.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Display response from the server
        } else {
            alert("Error adding property");
        }
    };

    // Send the data to the server
    xhr.send(JSON.stringify(data));
}

// Add event listeners
document.getElementById("confirmUpdatesButton").addEventListener("click", addProperty);

// Function to close the popup container
function closePopupContainer() {
    document.getElementById("popupContainer").style.display = "none";
}

// Add event listener for close button
document.querySelector(".popup-close-button").addEventListener("click", closePopupContainer);


</script>

</body>
</html>