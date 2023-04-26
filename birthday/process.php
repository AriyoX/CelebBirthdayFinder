<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>All Celebrities</title>
  <link rel="stylesheet" type="text/css" href="process.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    p {
      font-size: 18px;
      line-height: 1.5;
      margin-bottom: 20px;
    }
    button {
      font-size: 16px;
      padding: 10px 20px;
      background-color: #4285f4;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin: 20px;
    }
    button:hover {
      background-color: #357ae8;
    }
  </style>
</head>
<body>
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
$name = mysqli_real_escape_string($conn, $_POST['name']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$type = mysqli_real_escape_string($conn, $_POST['type']);

// get famous people who share user's birthday and type
if ($type === 'all') {
  // if all categories selected, get all celebrities who share user's birthday
  $sql = "SELECT * FROM celebrities WHERE MONTH(birthday) = MONTH('$birthday') AND DAY(birthday) = DAY('$birthday')";
} else {
  // if specific category selected, get celebrities who share user's birthday and belong to that category
  $sql = "SELECT * FROM celebrities WHERE MONTH(birthday) = MONTH('$birthday') AND DAY(birthday) = DAY('$birthday') AND type = '$type'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $celebrities = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $celebrities[] = $row['name'];
  }

  $celebrities = array_unique($celebrities);

  // display list of famous people
if (!empty($celebrities)) {
  if (count($celebrities) > 5 && $type==='all') {
    // if more than 5 celebrities, display a button to view all celebrities
    echo "<p>You share your birthday with " . count($celebrities) . " celebrities. Click the button below to view all:</p>";
    echo "<button onclick='location.href=\"all.php?birthday=$birthday\"'>View All</button>";
  } else if (count($celebrities) > 5) {
    // if more than 5 celebrities, display a button to view all celebrities
    echo "<p>You share your birthday with " . count($celebrities) . " $type. Click the button below to view all:</p>";
    echo "<button onclick='location.href=\"all.php?type=$type&birthday=$birthday\"'>View All</button>";
  } else {
    // if 5 or fewer celebrities, display them in a sentence
    $celebritiesStr = implode(', ', $celebrities);
    echo "<p>Some famous $type you share a birthday with include $celebritiesStr.</p>";
  }

}
} else {
  // no famous people found
  echo "<p>Sorry $name, you do not share a birthday with any $type in our database. Please try a different celebrity type.</p>";
}

// offer option to change celebrity type
echo "<button onclick='location.href=\"index.php\"'>Change Celebrity Type</button>";

// close database connection
mysqli_close($conn);
?>

</body>
</html>
