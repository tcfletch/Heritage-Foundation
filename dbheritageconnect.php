<?php
$DATABASE_HOST = 'db5015587754.hosting-data.io';
$DATABASE_USER = 'dbu1451822';
$DATABASE_PASS = 'OswegoHistory1848!';
$DATABASE_NAME = 'dbs12731952';
try {
   $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME .
    ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $exception){
  exit('Failed to connect to database!');
  
}
function insertData($tableName,$data){
  //call upon connection
      global $pdo;
  //join data array with commas for queries, until the end of the data is reached
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), '?'));
        $query = "INSERT INTO $tableName ($columns) VALUES ($values)";
        
        $stmt = $pdo->prepare($query);
        
        try {
            $stmt->execute(array_values($data));
            echo "<script>alert('Data inserted successfully!');</script>";
        } catch (PDOException $except) {
            echo "<script>alert('Error inserting data: " . addslashes($except->getMessage()) . "');</script>";
        }
}
function searchData($tableName,$data,$limit = null, $offset = null){
  global $pdo;
  $results =[];
  $query = "SELECT * FROM $tableName WHERE 1=1";
  $params = [];
  
   if (isset($data['streetName'])&& !empty($data['streetName'])) {
        $query .= " AND building_street LIKE ?";
        $params[] = '%' . $data['streetName'] . '%';
    }
    if (isset($data['streetNumber'])&& !empty($data['streetNumber'])) {
        $query .= " AND Building_Street_num LIKE ?";
        $params[] = '%' . $data['streetNumber'] . '%';
    }
    if (isset($data['town'])&& !empty($data['town'])) {
        $query .= " AND building_town_city LIKE ?";
        $params[] = '%' . $data['town'] . '%';
    }
    if (isset($data['lastName'])&& !empty($data['lastName'])) {
        $query .= " AND Owner_at_inventory_last_name LIKE ?";
        $params[] = '%' . $data['lastName'] . '%';
    }
    if (isset($data['historicalDistrict'])&& !empty($data['historicalDistrict'])) {
        $query .= " AND Historic_District LIKE ?";
        $params[] = '%' . $data['historicalDistrict'] . '%';
    }
    if (isset($data['village'])&& !empty($data['village'])) {
        $query .= " AND Building_Village LIKE ?";
        $params[] = '%' . $data['village'] . '%';
    }
    if (isset($data['buildingSide'])&& !empty($data['buildingSide'])) {
        $query .= " AND side_of_street LIKE ?";
        $params[] = '%' . $data['buildingSide'] . '%';
    }
    if (isset($data['architect'])&& !empty($data['architect'])) {
        $query .= " AND Architect LIKE ?";
        $params[] = '%' . $data['architect'] . '%';
    }
    if (isset($data['architectStyle'])&& !empty($data['architectStyle'])) {
        $query .= " AND Architectural_Style LIKE ?";
        $params[] = '%' . $data['architectStyle'] . '%';
    }
	if ($limit !== null && $offset !== null) {
        $query .= " LIMIT $limit OFFSET $offset";
    }
  
  $stmt = $pdo->prepare($query);
  try{
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $except){
    error_log("Error executing query: ".$except->getMessage());
  }
  return $results;
}
function loginCheck($tableName, $data) {
    global $pdo;

    //check for inputs
    if (isset($data['username']) && isset($data['password'])) {
        //store inputs
        $username = $data['username'];
        $password = $data['password'];

        // create query
        $query = "SELECT * FROM $tableName WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);
        
        try {
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // success
              	header("Location: adminPage.html");
                echo "<script>alert('Successful Login!');</script>";
              	exit();
              
            } else {
                // invalid users
                echo "<script>alert('Invalid username or password. Please try again.');</script>";
            }
        } catch (PDOException $e) {
            // internal problems
            echo "<script>alert('An error occurred. Please try again later.');</script>";
            // errors 
            error_log($e->getMessage());
        }
    } else {
        //need both to match
        echo "<script>alert('Please enter both username and password.');</script>";
    }
}

?>