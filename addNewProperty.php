<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Suggest A Property</title>
<script>
    function updateOrInsertData(rowData) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'addToDatabase.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            }
        };
        xhr.send(JSON.stringify(rowData));
    }
</script>
</head>
<body>
<?php
require 'dbheritageconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'buildingName' => $_POST['buildingName'],
        'townCity' => $_POST['townCity'],
        'village' => $_POST['village'],
        'dateUpdate' => $_POST['dateUpdate'],
        'taxMap' => $_POST['taxMap'],
        'streetNumber' => $_POST['streetNumber'],
        'streetName' => $_POST['streetName'],
        'currentCondition' => $_POST['currentCondition'],
        'yearCondition' => $_POST['yearCondition'],
        'presentOwner' => $_POST['presentOwner'],
        'otherOwners' => $_POST['otherOwners'],
        'historicDistrict' => $_POST['historicDistrict'],
        'hamlet' => $_POST['hamlet'],
        'streetSide' => $_POST['streetSide'],
        'architecturalStyle' => $_POST['architecturalStyle'],
        'notes' => $_POST['notes']
    ];
 
    $tableName = 'suggestions';
    insertData($tableName, $data);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Property Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        display: flex;
        background-color: #bcbda2;
        flex-direction: column;
    }

    h2 {
        font-size: 45px;
        color: #333;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .container {
        background-color: #a6a6a6;
        padding: 30px;
        width: 60%;
        max-width: 70%;
        position: relative;
        display: flex;
        justify-content: center;
        margin: 20px auto;
        border-radius: 10px;
        transition: 3s;
        font-weight: bold;
        flex-wrap: wrap; /* Added */
    }

    .search-form-container {
        width: 100%; /* Changed width to 100% */
        padding: 0 20px;
        position: relative; /* Added */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-size: 18px; /* Added */
        color: #333; /* Added */
    }

    input[type="text"],
    select {
        width: calc(100% - 22px);
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 16px; /* Added */
        color: #333; /* Added */
    }



    .button {
        background-color: #303030;
        border: none;
        color: white;
        padding: 15px;
        text-align: center;
        text-decoration: none;
        display: block;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        margin: 10px auto;
        border-radius: 5px;
        width: 100%;
        max-width: 400px;
    }

    .button:hover {
        background-color: #444;
    }

    .home-button {
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: 10%;
        background-color: #303030;
    }

    @media only screen and (max-width: 600px) {
        .container {
            flex-direction: column;
            align-items: center;
        }

        .search-form-container {
            width: 100%;
            padding: 0 10px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <div class="search-form-container">
        <form method = "POST" >
            <h2>Add New Property Information</h2>

            <label for="buildingName">Building Name:</label>
            <input type="text" id="buildingName" name="buildingName">

            <label for="townCity">Town/City:</label>
            <input type="text" id="townCity" name="townCity">

            <label for="village">Village:</label>
            <input type="text" id="village" name="village">

            <label for="dateUpdate">Date of Update:</label>
            <input type="text" id="dateUpdate" name="dateUpdate">

            <label for="taxMap">Tax Map #:</label>
            <input type="text" id="taxMap" name="taxMap">

            <label for="streetNumber">Street # (Numeric Values Only):</label>
            <input type="text" id="streetNumber" name="streetNumber">

            <label for="streetName">Street Name:</label>
            <input type="text" id="streetName" name="streetName">

            <label for="currentCondition">Current Condition:</label>
            <select id="currentCondition" name="currentCondition">
              	<option value="">-- Select --</option>
                <option value="Burned">Burned</option>
                <option value="Collapsed">Collapsed</option>
                <option value="Demolished">Demolished</option>
                <option value="Excellent">Excellent</option>
                <option value="Fair">Fair</option>
                <option value="Gone">Gone</option>
                <option value="Good">Good</option>
                <option value="Poor">Poor</option>
            </select>

            <label for="yearCondition">Year Burned / Collapsed / Demolished:</label>
            <input type="text" id="yearCondition" name="yearCondition">

            <label for="presentOwner">Present Owner:</label>
            <input type="text" id="presentOwner" name="presentOwner">

            <label for="otherOwners">Other Known Owners:</label>
            <input type="text" id="otherOwners" name="otherOwners">

            <label for="historicDistrict">Historic District:</label>
            <input type="text" id="historicDistrict" name="historicDistrict">

            <label for="hamlet">Hamlet:</label>
            <input type="text" id="hamlet" name="hamlet">

            <label for="streetSide">What Side of the Street is Structure Located?:</label>
            <select id="streetSide" name="streetSide">
              	<option value="">-- Select --</option>
                <option value="North">North</option>
                <option value="South">South</option>
                <option value="East">East</option>
                <option value="West">West</option>
                <option value="Northeast">Northeast</option>
                <option value="Northwest">Northwest</option>
                <option value="Southeast">Southeast</option>
                <option value="Southwest">Southwest</option>
            </select>

            <label for="architecturalStyle">Architectural Style:</label>
            <input type="text" id="architecturalStyle" name="architecturalStyle">

            <label for="notes">Notes:</label><br>
            <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>

            <button class="button" type="submit">Submit</button>
        </form>
      
      <script src="script.js"></script>
      
    </div>
    <div id="contact-container"></div>
</div>

<a href="index.php" class="button home-button">Home</a>
<button onclick="goBack()"class="button" style="position: fixed; bottom: 20px; right: 20px; width: 10%;">Back</button>

<script>
function goBack() {
  window.history.back();
}

// Dynamically add contact button and text
window.onload = function() {
  var contactContainer = document.getElementById("contact-container");
  var contactButton = document.createElement("a");
  contactButton.setAttribute("href", "contactUs.html");
  contactButton.setAttribute("class", "button");
  contactButton.textContent = "Contact Us";

  var haveQuestionsText = document.createElement("p");
  haveQuestionsText.textContent = "Have any questions?";

  contactContainer.appendChild(haveQuestionsText);
  contactContainer.appendChild(contactButton);
};
</script>
</body>
</html>
