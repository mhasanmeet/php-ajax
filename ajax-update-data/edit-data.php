<?php

$edit_id = $_POST['id'];

include "./database-conn.php";

$edit_sql = "SELECT * FROM students WHERE id = {$edit_id}";
$result = mysqli_query($conn, $edit_sql) or die("SQL query failed");

if(mysqli_num_rows($result) > 0){
    
    // variable to hold table body HTML
    $tableBody = "";
    // Variable to hold table footer HTML
    $tableFooter = "";

    while($row = mysqli_fetch_assoc($result)){
        // send two html payload into two separate html div
        $tableBody .= "<tr>
                <td>First Name</td>
                <td><input type='text' id='edit-fname' value='{$row["first_name"]}'></td>
                <td><input type='text' id='update-id' value='{$row["id"]}' hidden></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type='text' id='edit-lname' value='{$row["last_name"]}'></td>
            </tr>";

        $tableFooter .= "<button type='button' class='btn btn-primary' id='edit-submit'>Save</button> 
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
    }
    mysqli_close($conn);

    // Combine table body and footer HTML into a single response separated by a delimiter
    echo $tableBody . "|||" . $tableFooter;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>