<?php
require 'dbheritageconnect.php';
$property_details = null;
$allFiles = [];

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $query = "SELECT * FROM main_build WHERE record_name = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $property_details = $statement->fetch(PDO::FETCH_ASSOC);

  	$pdfInitFiles = glob("/formsAndPictures/{$id}.pdf"); // Wont display pdf files at the moment
    $pdfFiles = glob("/formsAndPictures/{$id}-*.pdf");
    $jpgFiles = glob("formsAndPictures/{$id}-*.jpg");
  	$jpgInitFiles = glob("formsAndPictures/{$id}.jpg");
    $allFiles = array_merge($pdfInitFiles,$pdfFiles, $jpgFiles,$jpgInitFiles);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historical Sites in Oswego County</title>
<style>

    body {
      font-family: Arial, sans-serif;
      background-color: #bcbda2;
      margin: 0;
      padding: 0;
      position: relative;
    }

    .container {
      position: relative;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      margin-top: 50px;
    }

    .left-container, .photos-container {
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .left-container {
      width: 30%;
      height: 100%;
      border: 1px solid #ccc;
      margin-right: 20px;
      display: flex;
      flex-direction: column;
      align-items: left;
      justify-content: left;
      background-color: #a6a6a6;
      padding-left: 20px;
    }

    .left-container h1 {
      color: #333;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      margin-bottom: 20px;
      text-align: left;
    }

    .left-field {
      margin-left: 20px;
      margin-bottom: 10px;
      font-size: 20px;
      color: #000000;

    }

    .left-field span {
      font-weight: bold;
      color: #666;

    }

    .photos-container {
      width: 70%;
      height: 600px;
      border: 1px solid #ccc;
      position: relative;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #a6a6a6;
      position: relative;
      padding: 20px;
    }

    .photos {
      max-width: 90%;
      max-height: 90%;
      position: relative;
      display: flex;
      justify-content: space-between;
    }

    .photos img {
      max-width: 100%;
      max-height: 100%;
      object-fit: cover;
    }

    .photos-label {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
      text-align: center;
      color: #333333;
      margin-top: 20px;
      position: absolute;
  	  top: 10px;
   	  left: 50%;
  	  transform: translateX(-50%);
  	  width: 100%;
      margin-bottom: 20px;
    }

    .update-button-container {
      position: absolute;
      top: 3%;
      right: 10%;
    }

    .update-button {
      background-color: #303030;
      border: none;
      color: white;
      padding: 15px;
      text-align: center;
      text-decoration: none;
      display: block;
      font-size: calc(100% - 20%);
      font-weight: bold;
      cursor: pointer;
      border-radius: 5px;
      width: 150px;
    }

    .update-button:hover {
      background-color: #45a049;
    }

    #prevBtn, #nextBtn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: #ffffff;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    #prevBtn {
      left: 10px;
    }

    #nextBtn {
      right: 0;
    }

    #prevBtn:hover, #nextBtn:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    .building-name {
      font-size: 50px;
      color: #333;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      margin-left: 10%;
      margin-top: 3%;
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
<div>
  <?php
$buildingName = (!empty($property_details['Building_Name'])) ? $property_details['Building_Name'] : '';
$recordName = (!empty($property_details['record_name'])) ? "Record: " . $property_details['record_name'] : '';
?>
<div class="building-name"><?php echo ($buildingName != '') ? $buildingName : $recordName; ?></div>
  
  <div class="update-button-container">
    <form action="updateForm.php" method="get">
  <button type="submit" class="update-button">Update Property</button>
</form>
  </div>
</div>

<div class="container">
<div class="left-container">
    <?php
    if ($property_details) {
        $include_keys = array(
            'Building_Name' => 'Building Name',
            'record_name' => 'Record Name',
            'Building_Street' => 'Street',
            'Building_Street_Num' => 'Street Number',
            'Building_Town_City' => 'Town/City',
            'Building_Village' => 'Village',
            'side_of_street' => 'Side of Street',
            'Architect' => 'Architect',
            'Architectural_Style' => 'Architectural Style',
            'Historical_and_architectural_importance' => 'Historical Significance',
            'Ownership' => 'Ownership',
            'Other_notable_features' => 'Notable Features'
        );
        foreach ($include_keys as $key => $label) {
            echo '<div class="left-field"><span style="color: #333333; font-weight: bold; font-style: italic;"><u>' . $label . ':</u></span> <span style="color: black;">' . ($property_details[$key] ? $property_details[$key] : 'N/A') . '</span></div>';
        }
    }
  	echo '<script>';
    echo 'var propertyData = ' . json_encode($property_details) . ';'; 
    echo '</script>';
    ?>
</div>
  <div class="photos-container">
    <button id="prevBtn" onclick="prevPhoto()">Previous</button>
    <?php
	$numPhotos = count($allFiles);
	$label = ($numPhotos > 0) ? "Photo Gallery ($numPhotos photo(s) found)" : "No photos were found";
	echo "<div class='photos-label'>$label</div>";
	?>
    <div class="photos">
    <?php
    foreach ($allFiles as $allFile) {
        if (pathinfo($allFile, PATHINFO_EXTENSION) === 'pdf') {
            echo '<iframe src="' . $allFile . '" width="100%" height="600px" frameborder="0"></iframe>';
        } else {
            echo '<img src="' . $allFile . '" alt="Image">';
        }
    }
    ?>
    </div>
    <button id="nextBtn" onclick="nextPhoto()">Next</button>        
  </div>
<a href="index.php" class="button home-button">Home</a>
<button onclick="goBack()"class="button" style="position: fixed; bottom: 20px; right: 20px; width: 10%;">Back</button>

<script>
    function goBack() {
        window.history.back();
    }
	console.log(<?php echo json_encode($allFiles); ?>);
    var allFiles = <?php echo json_encode($allFiles); ?>;

    var currentIndex = 0;
    var photosContainer = document.querySelector('.photos');
    var prevBtn = document.getElementById('prevBtn');
    var nextBtn = document.getElementById('nextBtn');

    function showCurrentPhoto() {
        var currentFile = allFiles[currentIndex];
        photosContainer.innerHTML = `<img src="${currentFile}" alt="Image ${currentIndex + 1}">`;
    }

    function prevPhoto() {
        currentIndex = (currentIndex - 1 + allFiles.length) % allFiles.length;
        showCurrentPhoto();
    }

    function nextPhoto() {
        currentIndex = (currentIndex + 1) % allFiles.length;
        showCurrentPhoto();
    }

    showCurrentPhoto();
  	  
  	async function fetchPropertyDataAndStore() {
        try {
            sessionStorage.setItem('propertyData', JSON.stringify(propertyData));
            console.log("Property data collected and stored successfully!");

        } catch (error) {
            if (error && error.message) {
                console.error("Error fetching or storing property data:", error.message);
            } else {
                console.error("Unknown error occurred while fetching or storing property data.");
            }
        }
    }

    fetchPropertyDataAndStore();
  
</script>
  </div>
</body>
</html>