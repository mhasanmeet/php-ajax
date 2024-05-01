<?php

// get objects from index.php
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

include "./database-conn.php";

$sql = "INSERT INTO students(`first_name`, `last_name`) VALUES('{$first_name}', '{$last_name}')";

// send response to ajax
if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}

?>