<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Page</title>
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
        width: 50%;
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
    /* Style for Confirm Updates button */
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
<script>
function openPopupContainer(recordName, buildingName, townCity, village, dateUpdate, streetNumber, streetName, currentCondition, yearCondition, presentOwner, otherOwners, historicDistrict, streetSide, architecturalStyle, notes, hamlet) {
    // Populate record name input box in the popup container
    document.getElementById("recordNameInput").value = recordName;

    // Make AJAX request to retrieve main build data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "retrieve_main_build_data.php?recordName=" + encodeURIComponent(recordName), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Response from PHP script:", xhr.responseText); // Debugging
                var mainBuildData = JSON.parse(xhr.responseText);
                console.log("Main build data:", mainBuildData); // Debugging
                if (mainBuildData) {
                    // Populate "Current Information" section with main_build data
                    document.getElementById("currentRecordName").textContent = recordName;
                    document.getElementById("currentBuildingName").textContent = mainBuildData.Building_Name;
                    document.getElementById("currentTownCity").textContent = mainBuildData.Building_Town_City;
                    document.getElementById("currentVillage").textContent = mainBuildData.Building_Village;
                    document.getElementById("currentDateUpdate").textContent = mainBuildData.last_updated;
                    document.getElementById("currentStreetNumber").textContent = mainBuildData.Building_Street_Num;
                    document.getElementById("currentStreetName").textContent = mainBuildData.Building_Street;
                    document.getElementById("currentCondition").textContent = mainBuildData.Current_Condition;
                    document.getElementById("currentYearCondition").textContent = mainBuildData.yearCondition;
                    document.getElementById("currentPresentOwner").textContent = mainBuildData.Present_owner_last_name;
                    document.getElementById("currentOtherOwners").textContent = mainBuildData.Other_known_owners;
                    document.getElementById("currentHistoricDistrict").textContent = mainBuildData.Historic_District;
                    document.getElementById("currentStreetSide").textContent = mainBuildData.side_of_street;
                    document.getElementById("currentArchitecturalStyle").textContent = mainBuildData.Architectural_Style;
                    document.getElementById("currentNotes").textContent = mainBuildData.Notes;
                    document.getElementById("currentHamlet").textContent = mainBuildData.Hamlet;
                }
            } else {
        // If mainBuildData is not available, display "N/A" for all fields
        document.getElementById("currentRecordName").textContent = "N/A";
        document.getElementById("currentBuildingName").textContent = "N/A";
        document.getElementById("currentTownCity").textContent = "N/A";
        document.getElementById("currentVillage").textContent = "N/A";
        document.getElementById("currentDateUpdate").textContent = "N/A";
        document.getElementById("currentStreetNumber").textContent = "N/A";
        document.getElementById("currentStreetName").textContent = "N/A";
        document.getElementById("currentCondition").textContent = "N/A";
        document.getElementById("currentYearCondition").textContent = "N/A";
        document.getElementById("currentPresentOwner").textContent = "N/A";
        document.getElementById("currentOtherOwners").textContent = "N/A";
        document.getElementById("currentHistoricDistrict").textContent = "N/A";
        document.getElementById("currentStreetSide").textContent = "N/A";
        document.getElementById("currentArchitecturalStyle").textContent = "N/A";
        document.getElementById("currentNotes").textContent = "N/A";
        document.getElementById("currentHamlet").textContent = "N/A";
               
            }
        }
    };
    xhr.send();

    // Populate "Suggested Information" section
    document.querySelector("#popupContainer [name='buildingName']").value = buildingName;
    document.querySelector("#popupContainer [name='townCity']").value = townCity;
    document.querySelector("#popupContainer [name='village']").value = village;
    document.querySelector("#popupContainer [name='dateUpdate']").value = dateUpdate;
    document.querySelector("#popupContainer [name='streetNumber']").value = streetNumber;
    document.querySelector("#popupContainer [name='streetName']").value = streetName;
    document.querySelector("#popupContainer [name='currentCondition']").value = currentCondition;
    document.querySelector("#popupContainer [name='yearCondition']").value = yearCondition;
    document.querySelector("#popupContainer [name='presentOwner']").value = presentOwner;
    document.querySelector("#popupContainer [name='otherOwners']").value = otherOwners;
    document.querySelector("#popupContainer [name='historicDistrict']").value = historicDistrict;
    document.querySelector("#popupContainer [name='streetSide']").value = streetSide;
    document.querySelector("#popupContainer [name='architecturalStyle']").value = architecturalStyle;
    document.querySelector("#popupContainer [name='notes']").value = notes;
    document.querySelector("#popupContainer [name='hamlet']").value = hamlet;

    // Toggle visibility of the popup container
    document.getElementById("popupContainer").style.display = "block";
}



function retrieveMainBuildData(recordName) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "retrieve_main_build_data.php?recordName=" + encodeURIComponent(recordName), false);
    xhr.send();
    if (xhr.status === 200) {
        console.log("Response from PHP script:", xhr.responseText); // Add this line for debugging
        return JSON.parse(xhr.responseText);
    } else {
        console.error("Error retrieving data from main_build: " + xhr.statusText);
        return null;
    }
}

function confirmUpdates() {
    var recordName = document.getElementById("recordNameInput").value;
    var updateValues = {
        Building_Name: document.querySelector("#popupContainer [name='buildingName']").value.trim(),
        Building_Town_City: document.querySelector("#popupContainer [name='townCity']").value.trim(),
        Building_Village: document.querySelector("#popupContainer [name='village']").value.trim(),
        last_updated: document.querySelector("#popupContainer [name='dateUpdate']").value.trim(),
        Building_Street_Num: document.querySelector("#popupContainer [name='streetNumber']").value.trim(),
        Building_Street: document.querySelector("#popupContainer [name='streetName']").value.trim(),
        Current_Condition: document.querySelector("#popupContainer [name='currentCondition']").value.trim(),
        Present_owner_last_name: document.querySelector("#popupContainer [name='presentOwner']").value.trim(),
        Other_known_owners: document.querySelector("#popupContainer [name='otherOwners']").value.trim(),
        Historic_District: document.querySelector("#popupContainer [name='historicDistrict']").value.trim(),
        side_of_street: document.querySelector("#popupContainer [name='streetSide']").value.trim(),
        Architectural_Style: document.querySelector("#popupContainer [name='architecturalStyle']").value.trim(),
        Notes: document.querySelector("#popupContainer [name='notes']").value.trim(),
        Hamlet: document.querySelector("#popupContainer [name='hamlet']").value.trim()
    };

    // Remove empty values from the updateValues object
    for (var key in updateValues) {
        if (!updateValues[key]) {
            delete updateValues[key];
        }
    }

    // Send the data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_database.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
        } else {
            alert("Error updating database");
        }
    };
    xhr.send(JSON.stringify({recordName: recordName, updateValues: updateValues}));
}


function closePopupContainer() {
    document.getElementById("popupContainer").style.display = "none";
}
</script>

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


$tableName = "update_property";
$columns = "buildingName, recordName, townCity, village, dateUpdate, streetNumber, streetName, currentCondition, yearCondition, presentOwner, otherOwners, historicDistrict, streetSide, architecturalStyle, notes, hamlet";

$data = retrieveData($tableName, $columns);

if ($data) {
    // Start HTML output
    echo '<table border="1" cellpadding="5">';
    // Table headers
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
            '{$row['streetNumber']}',
            '{$row['streetName']}',
            '{$row['currentCondition']}',
            '{$row['yearCondition']}',
            '{$row['presentOwner']}',
            '{$row['otherOwners']}',
            '{$row['historicDistrict']}',
            '{$row['streetSide']}',
            '{$row['architecturalStyle']}',
            '{$row['notes']}',
            '{$row['hamlet']}'
        )\">Add to Database</button></td>";

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
    <!-- Left section -->
    <div class="popup-section">
        <!-- Content goes here -->
        <h3>Current Information</h3>
        <ul>
            <li><strong>Record Name:</strong> <span id="currentRecordName"></span></li>
            <li><strong>Building Name:</strong> <span id="currentBuildingName"></span></li>
            <li><strong>Town/City:</strong> <span id="currentTownCity"></span></li>
            <li><strong>Village:</strong> <span id="currentVillage"></span></li>
            <li><strong>Date Update:</strong> <span id="currentDateUpdate"></span></li>
            <li><strong>Street Number:</strong> <span id="currentStreetNumber"></span></li>
            <li><strong>Street Name:</strong> <span id="currentStreetName"></span></li>
            <li><strong>Current Condition:</strong> <span id="currentCondition"></span></li>
            <li><strong>Year Condition:</strong> <span id="currentYearCondition"></span></li>
            <li><strong>Present Owner:</strong> <span id="currentPresentOwner"></span></li>
            <li><strong>Other Owners:</strong> <span id="currentOtherOwners"></span></li>
            <li><strong>Historic District:</strong> <span id="currentHistoricDistrict"></span></li>
            <li><strong>Street Side:</strong> <span id="currentStreetSide"></span></li>
            <li><strong>Architectural Style:</strong> <span id="currentArchitecturalStyle"></span></li>
            <li><strong>Notes:</strong> <span id="currentNotes"></span></li>
            <li><strong>Hamlet:</strong> <span id="currentHamlet"></span></li>
        </ul>
    </div>
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
            <li><strong>Street Number:</strong> <input type="text" name="streetNumber"></li>
            <li><strong>Street Name:</strong> <input type="text" name="streetName"></li>
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
    <button id="confirmUpdatesButton">Confirm Updates</button>

  
    <!-- Close button -->
<button class="popup-close-button" onclick="closePopupContainer()">Close</button>

</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("confirmUpdatesButton").addEventListener("click", function() {
        confirmUpdates();
    });
});
</script>


</body>
</html>