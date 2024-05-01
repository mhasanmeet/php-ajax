<?php

// get delete object data from index.php 
$delete_id = $_POST["id"]; 

include "./database-conn.php";

$delete_sql = "DELETE FROM students WHERE id = {$delete_id}";

if(mysqli_query($conn, $delete_sql)){
    echo 1;
}else{
    echo 0;
}

?>