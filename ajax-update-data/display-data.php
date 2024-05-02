<?php
    
include "./database-conn.php";

$sql = "SELECT * from students";
$result = mysqli_query($conn, $sql) or die("SQL query failed");

if(mysqli_num_rows($result) > 0){
    echo '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>'; 

                while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                                        <td>{$row["id"]}</td>
                                        <td>{$row["first_name"]} {$row["last_name"]}</td>
                                        <td><button type='button' data-bs-toggle='modal' data-bs-target='#editModal' class='btn btn-primary edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
                                        <td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
                                    </tr>";
                                }
    echo "</table>";
    mysqli_close($conn);

} else{
    echo "<h2>No Result Found </h2>";
}

?>