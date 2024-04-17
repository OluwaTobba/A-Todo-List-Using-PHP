<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "todo-list";
    $conn = null;

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>


<!-- $sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "todo-list";

try {
    $conn 
} -->


<!-- $conn= new mysqli('localhost','root','','todo-list');

if (!$conn)
{
    error_reporting(0);
    die("Could not connect to mysql".mysqli_error($conn));
} -->


<!-- $db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "todo-list";
$conn = "";

try{
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
}
catch(mysqli_sql_exception){
    echo "Error connecting<br>";
} -->
