<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>All Celebrities</title>
  <style>
    h1 {
      color: #333;
      font-family: Arial, sans-serif;
      text-align: center;
    }
    p {
      font-family: Arial, sans-serif;
      font-size: 18px;
      line-height: 1.5;
      color: #333;
      margin: 0 0 10px;
    }
    ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    li {
      font-family: Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      color: #333;
      margin: 0 0 5px;
    }
    button {
      background-color: #007bff;
      color: #fff;
      font-family: Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }
    button:hover {
      background-color: #0062cc;
    }
  </style>
</head>
<body>
  <h1>All Celebrities</h1>
  <?php

  // display any potential errors
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // connect to database
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $dbname = 'famous_people';
  $conn = mysqli_connect($host, $user, $password, $dbname);
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // get form data
  $birthday = mysqli_real_escape_string($conn, $_GET['birthday']);

  // incase no type is passed on from the process.php page
  if (isset($_GET['type'])) {
    $type = mysqli_real_escape_string($conn, $_GET['type']);
  } else {
    $type = 'all'; 
  }
  

  // format date to a better format
  $formattedDate = date('jS F', strtotime($birthday));

  // get famous people who share user's birthday and type
if($type === 'all'){
  $sql = "SELECT * FROM celebrities WHERE MONTH(birthday) = MONTH('$birthday') AND DAY(birthday) = DAY('$birthday')";
} else {
  $sql = "SELECT * FROM celebrities WHERE type = '$type' AND MONTH(birthday) = MONTH('$birthday') AND DAY(birthday) = DAY('$birthday')";
}

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // display list of famous people
  echo "<p>";
  if($type === 'all'){
    echo "Famous people who were born on $formattedDate :";
  } else {
    echo "Famous $type who were born on $formattedDate :";
  }
  echo "</p>";
  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>{$row['name']}</li>";
  }
  echo "</ul>";
} else {
  // no famous people found
  if($type === 'all'){
    echo "<p>Sorry $name, no famous people were born on $formattedDate.</p>";
  } else {
    echo "<p>Sorry $name, you do not share a birthday with any $type.</p>";
  }
}

// close database connection
mysqli_close($conn);

  ?>

  <button onclick="window.location.href='index.php'">Change Celebrity Type</button>
</body>
</html>
