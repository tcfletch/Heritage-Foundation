<?php
session_start();

if(isset($_SESSION['search_results'])) {
    $results = $_SESSION['search_results'];
    $num_res = count($results);
    $numPerPage = 20;
    $totalPages = ceil($num_res / $numPerPage);

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $numPerPage;
    $resultsPerPage = array_slice($results, $startFrom, $numPerPage);

    echo "<script>";
    echo "console.log('Search Results:', " . json_encode($results) . ");";
    echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
 <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #bcbda2;
      margin: 0;
      padding: 0;
      position: relative;
    }

    .container {
      display: flex;
      justify-content: center;
      gap: 20px; 
    }

    .left-column, .right-column {
      width: 50%;
    }

    .left-container, .right-container {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 20px;
    }

    .left-field {
      margin-bottom: 10px;
      font-size: 16px;
      color: #333;
    }

    .left-field span {
      font-weight: bold;
      color: black; 
    }

    .left-field span.value {
      font-weight: normal;
    }

    .pagination-container {
      display: flex;
      justify-content: center;
      margin-bottom: 20px; 
    }

    .btn {
      background-color: #343a40; 
      color: #ffffff; 
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #495057; 
    }

     mx-1 {
       margin-right: 8px; 
    }

    .text-light {
      color: #fffdd0;
    }
   .active-page {
    background-color: #B1A3BD;
    color: #ffffff; 
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
   .result-link:hover .left-container, .result-link:focus .left-container {
  border-color: #45a049;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
	}
  </style>
</head>
<body>
   <h1>Search Results</h1>
 
<?php if ($num_res > 0): ?>
    <p><?php echo $num_res; ?> result(s) found.</p>
    <p>Showing results <?php echo $startFrom + 1; ?> to <?php echo min($startFrom + $numPerPage, $num_res); ?></p>
    <div class="container">
        <?php $half_count = ceil(count($resultsPerPage) / 2); ?>
        <div class="left-column">
            <?php foreach (array_slice($resultsPerPage, 0, $half_count) as $result): ?>
                <a href="result_details.php?id=<?php echo $result['record_name']; ?>" class="result-link">
                    <div class="left-container">
                        <div class="left-field"><span>Building Name:</span> <span><?php echo htmlspecialchars($result['Building_Name']); ?></span></div>
                        <div class="left-field"><span>Record Name:</span> <span><?php echo htmlspecialchars($result['record_name']); ?></span></div>
                        <div class="left-field"><span>Historical Significance:</span> <span><?php echo htmlspecialchars($result['Historical_and_architectural_importance']); ?></span></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="right-column">
            <?php foreach (array_slice($resultsPerPage, $half_count) as $result): ?>
                <a href="result_details.php?id=<?php echo $result['record_name']; ?>" class="result-link">
                    <div class="left-container">
                        <div class="left-field"><span>Building Name:</span> <span><?php echo htmlspecialchars($result['Building_Name']); ?></span></div>
                        <div class="left-field"><span>Record Name:</span> <span><?php echo htmlspecialchars($result['record_name']); ?></span></div>
                        <div class="left-field"><span>Historical Significance:</span> <span><?php echo htmlspecialchars($result['Historical_and_architectural_importance']); ?></span></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <p>No results found.</p>
<?php endif; ?>
<?php if ($totalPages > 1): ?>
  <div class="pagination-container">
    <?php if ($page > 1): ?>
      <button class="btn btn-dark mx-1"><a href="result.php?page=<?php echo max(1, $page - 10); ?>" class="text-light">Previous</a></button>
    <?php endif; ?>
	<?php for ($btn = max(1, $page - 9); $btn <= min($totalPages, $page + 10); $btn++): ?>
    <button class="btn btn-dark mx-1 <?php echo ($btn == $page) ? 'active-page' : ''; ?>"><a href="result.php?page=<?php echo $btn; ?>" class="text-light"><?php echo $btn; ?></a></button>
	<?php endfor; ?>
    <?php if ($totalPages > $page + 10): ?>
      <button class="btn btn-dark mx-1"><a href="result.php?page=<?php echo $page + 10; ?>" class="text-light">Next</a></button>
    <?php endif; ?>
  </div>
<?php endif; ?>
 <a href="index.php" class="button home-button">Home</a>
 <button onclick="goBack()"class="button" style="position: fixed; bottom: 20px; right: 20px; width: 10%;">Back</a>

 <script>
    function goBack() {
      window.history.back();
    }
</script>
</body>
</html>
