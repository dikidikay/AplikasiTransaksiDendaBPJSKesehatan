<?php



$kn = $_GET['nova'];

$databaseHost = 'localhost';
$databaseName = 'data';
$databaseUsername = 'root';
$databasePassword = '';


$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

$result = mysqli_query($mysqli,"SELECT * FROM pancing");
$idd = mysqli_num_rows($result);

$sql = "INSERT INTO pancing (id,ikan) VALUES ('$idd','$kn')";
$query = mysqli_query($mysqli,$sql);
// $test = $conn->query("INSERT INTO data48 (data) VALUES ($data48)");
// if ($query === TRUE) {
//     echo "mantap";
// } else {
//     mysqli_close($mysqli);
// }