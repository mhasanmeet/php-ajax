<?php

$updateBtn_Id = $_POST['id'];
$updateFname = $_POST['first_name'];
$updateLname = $_POST['last_name'];

include "./database-conn.php";

$update_sql = "UPDATE students SET first_name = '{$updateFname}', last_name = '{$updateLname}' WHERE id = {$updateBtn_Id}";

if(mysqli_query($conn, $update_sql)){
    echo 1;
}else{
    echo 0;
}

?>