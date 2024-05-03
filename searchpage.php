<?php
require 'dbheritageconnect.php';
$tableName = 'main_build';
$results =[];

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'streetName' => $_POST['streetName'],
        'streetNumber' => $_POST['streetNumber'],
        'town' => $_POST['town'],
        'lastName' => $_POST['lastName'],
        'historicalDistrict' => $_POST['historicalDistrict'],
        'village' => $_POST['village'],
        'buildingSide' => $_POST['buildingSide'],
        'architect' => $_POST['architect'],
        'architectStyle' => $_POST['architectStyle'],
    ];
    $results = searchData($tableName, $data);
    
	if (!empty($results)) {
        $_SESSION['search_results'] = $results;
        $_SESSION['search_query'] = $data; 
        header("Location: result.php");
        exit();
    } else {
        echo "<script>alert('No results found. Please try broadening your search.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Historical Database Search</title>
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
  .checkbox-container {
     display: flex;
     align-items: center;
     width: 100%;
   }
   .checkbox-container label {
     margin-right: 10px;
     display: inline-block;
   }
   .checkbox-container input[type="checkbox"] {
     width: 20px;
     height: 20px;
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

  .advanced-search {
   display: none;
   background-color: #a6a6a6;
   padding: 20px;
   border-radius: 5px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
   margin-top: 20px; /* Adjusted margin */
   opacity: 0; /* Initially hidden */
   transition: opacity 1s ease-in-out, height 3s ease; /* Transition for opacity */
  }

  label {
   display: block;
   margin-bottom: 5px;
  }
  input[type="text"],
  select {
   width: calc(100% - 22px);
   padding: 10px;
   border: 1px solid #ccc;
   margin-bottom: 15px;
  }
  select {
    font-size: 16px;
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
  .home-button {
   position: fixed;
   bottom: 20px;
   left: 20px;
   width: 10%;
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
   <form class="search-form" id="searchForm" method="POST">
    <h2>Property Look Up</h2>

    <label for="streetName">Street Name:</label>
    <input type="text" id="streetName" name="streetName" placeholder="Enter Street Name">

    <label for="streetNumber">Street Number (Numeric Values Only)</label>
    <input type="text" id="streetNumber" name="streetNumber" placeholder="Enter Street Number">

    <label for="town">Town:</label>
    <select id="town" name="town" style="width: 100%;">
      <option value="">-- Select --</option>
      <option value="Albion">Albion</option>
      <option value="Amboy">Amboy</option>
      <option value="Boylston">Boylston</option>
      <option value="Constantia">Constantia</option>
      <option value="Ellisburg">Ellisburg</option>
      <option value="Fulton">Fulton</option>
      <option value="Granby">Granby</option>
      <option value="Hannibal">Hannibal</option>
      <option value="Hastings">Hastings</option>
      <option value="Mexico">Mexico</option>
      <option value="Minetto">Minetto</option>
      <option value="New Haven">New Haven</option>
      <option value="Orwell">Orwell</option>
      <option value="Oswego">Oswego</option>
      <option value="Oswego City">Oswego City</option>
      <option value="Oswego Town">Oswego Town</option>
      <option value="Palermo">Palermo</option>
      <option value="Parish">Parish</option>
      <option value="Redfield">Redfield</option>
      <option value="Richland">Richland</option>
      <option value="Sandy Creek">Sandy Creek</option>
      <option value="Schroeppel">Schroeppel</option>
      <option value="Scriba">Scriba</option>
      <option value="Volney">Volney</option>
      <option value="West Monroe">West Monroe</option>
      <option value="Williamstown">Williamstown</option>
    </select>

    <label for="lastName"> Owner's Last Name</label>
    <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name">

    <div class="advanced-search">
      <label for="historicalDistrict">Historical District</label>
      <input type="text" id="historicalDistrict" name="historicalDistrict" placeholder="Enter Historical District">

      <label for="village">Village</label>
      <input type="text" id="village" name="village" placeholder="Enter Village">

      <label for="buildingSide">Side of Road:</label>
      <select id="buildingSide" name="buildingSide" style="width: 100%;">
        <option value="">-- Select --</option>
        <option value="North">North</option>
        <option value="East">East</option>
        <option value="West">West</option>
        <option value="Northeast">Northeast</option>
        <option value="Northwest">Northwest</option>
        <option value="Southeast">Southeast</option>
        <option value="Southwest">Southwest</option>
      </select>

      <label for="architect">Architect</label>
      <input type="text" id="architect" name="architect" placeholder="Enter Architect">

      <label for="architectStyle">Architect Style</label>
      <input type="text" id="architectStyle" name="architectStyle" placeholder="Enter Architect Style">
    </div>

    <button class="button" type="submit">Search</button>
    <a href="#" class="button" id="advancedSearchButton">Advanced Search</a>
   </form>
  </div>
 </div>

 <a href="index.php" class="button home-button">Home</a>
 <button onclick="goBack()"class="button" style="position: fixed; bottom: 20px; right: 20px; width: 10%;">Back</a>

 <script>
    function goBack() {
      window.history.back();
    }
   var advancedSearchButton = document.getElementById('advancedSearchButton');
   var advancedSearchDiv = document.querySelector('.advanced-search');

   advancedSearchButton.addEventListener('click', function() {
     if (advancedSearchDiv.style.display === 'none') {
       advancedSearchDiv.style.display = 'block';
       setTimeout(function() {
         advancedSearchDiv.style.opacity = '1';
       }, 10);
       advancedSearchButton.textContent = 'Hide Advanced Search';
     } else {
       advancedSearchDiv.style.opacity = '0';
       setTimeout(function() {
         advancedSearchDiv.style.display = 'none';
       }, 1000);
       advancedSearchButton.textContent = 'Advanced Search';
     }
   });
 </script>
</body>
</html>