<?php
require 'dbheritageconnect.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$data = [
	'username'=> $_POST['username'],
    'password'=> $_POST['password']
];
  $tableName = 'users';
  loginCheck($tableName,$data);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        display: flex;
        background-color: #bcbda2;
        flex-direction: column;
        align-items: center; 
        justify-content: center;
        height: 100vh;
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
        border-radius: 10px;
        transition: 3s;
        font-weight: bold;
        flex-wrap: wrap;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-size: 18px;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
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

</style>
</head>
<body>
<div class="container">
    <h2>Admin Login</h2>
    <form method = "POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button class="button" type="submit" name="login">Log In</button>
    </form>
</div>
<a href="index.php" class="button home-button">Home</a>
<button onclick="goBack()"class="button" style="position: fixed; bottom: 20px; right: 20px; width: 10%;">Back</a>

<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>