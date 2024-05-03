<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historical Sites in Oswego County</title>
  <script>
    var siteData = {
      photos: ["photo1.jpg", "photo2.jpg", "photo3.jpg"]
    };

    // Function to cycle through photos
    var currentPhotoIndex = 0;
    function prevPhoto() {
      if (siteData.photos.length > 0) {
        currentPhotoIndex = (currentPhotoIndex - 1 + siteData.photos.length) % siteData.photos.length;
        document.getElementById("siteImage").src = siteData.photos[currentPhotoIndex];
      }
    }

    function nextPhoto() {
      if (siteData.photos.length > 0) {
        currentPhotoIndex = (currentPhotoIndex + 1) % siteData.photos.length;
        document.getElementById("siteImage").src = siteData.photos[currentPhotoIndex];
      }
    }

    function setPlaceholders() {
      document.getElementById("buildingName").textContent = "Loading...";
      document.getElementById("streetName").textContent = "Loading...";
      document.getElementById("streetNumber").textContent = "Loading...";
      document.getElementById("town").textContent = "Loading...";
      document.getElementById("lastName").textContent = "Loading...";
      document.getElementById("historicalDistrict").textContent = "Loading...";
      document.getElementById("village").textContent = "Loading...";
      document.getElementById("sideOfRoad").textContent = "Loading...";
      document.getElementById("architect").textContent = "Loading...";
      document.getElementById("architectStyle").textContent = "Loading...";
    }

    async function fetchPropertyDataAndStore() {
      try {
        // Fetch property data
        const propertyData = await fetchPropertyData();

        // Store property data in session storage
        sessionStorage.setItem('propertyData', JSON.stringify(propertyData));
        console.log("Property data collected and stored successfully!");

        // Redirect to updateForm.php

      } catch (error) {
        if (error && error.message) {
          console.error("Error fetching or storing property data:", error.message);
        } else {
          console.error("Unknown error occurred while fetching or storing property data.");
        }
      }
    }

    async function fetchPropertyData() {
      try {
        // Simulate delay for fetching data
        await new Promise(resolve => setTimeout(resolve, 1000));

        return {
          buildingName: "Shineman",
          streetName: "Main Street",
          streetNumber: "123",
          town: "Oswego",
          lastName: "Smith",
          historicalDistrict: "Historical District",
          village: "Village Name",
          sideOfRoad: "East",
          architect: "Architect Name",
          architectStyle: "Architect Style"
        };
      } catch (error) {
        throw new Error("Error fetching property data.");
      }
    }

    // Automatically run fetchPropertyDataAndStore() when fetchPropertyData() is done loading
    window.onload = function() {
      fetchPropertyDataAndStore();
    };
  </script>
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
      height: 700px;
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
      width: 50%;
      height: 600px;
      border: 1px solid #ccc;
      position: relative;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #a6a6a6;
      position: relative;
    }

    .photos {
      width: 90%;
      height: 90%;
      position: relative;
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
      right: 10px;
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
  </style>
</head>
<body>
<div>
  <div class="building-name">Building Name</div>
  <div class="update-button-container">
    <form action="updateForm.php" method="get">
  <button type="submit" class="update-button">Update Property</button>
</form>
  </div>
</div>

<div class="container">
  <div class="left-container">
    <h1>Property Information</h1>
    <div class="left-field"><span>Building Name:</span> <span id="buildingName"></span></div>
    <div class="left-field"><span>Street Name:</span> <span id="streetName"></span></div>
    <div class="left-field"><span>Street Number:</span> <span id="streetNumber"></span></div>
    <div class="left-field"><span>Town:</span> <span id="town"></span></div>
    <div class="left-field"><span>Last Name:</span> <span id="lastName"></span></div>
    <div class="left-field"><span>Historical District:</span> <span id="historicalDistrict"></span></div>
    <div class="left-field"><span>Village:</span> <span id="village"></span></div>
    <div class="left-field"><span>Side of Road:</span> <span id="sideOfRoad"></span></div>
    <div class="left-field"><span>Architect:</span> <span id="architect"></span></div>
    <div class="left-field"><span>Architect Style:</span> <span id="architectStyle"></span></div>
  </div>

  <div class="photos-container">
    <div class="photos">
      <div class="photos-label">Photo Gallery</div>
      <img id="siteImage" src="placeholder.jpg" alt="Site Image">
    </div>

    <button id="prevBtn" onclick="prevPhoto()">Previous</button>
    <button id="nextBtn" onclick="nextPhoto()">Next</button>
  </div>
</div>


</body>
</html>
