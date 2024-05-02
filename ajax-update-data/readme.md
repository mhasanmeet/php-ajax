# Ajax Update Data

Ajax Update Data is a complex process 

## Edit button to show data in modal 
1. First we need to get hidden `id` table button from `display-data.php` file

table header

```php

<th>Edit</th>


```
table data from database 

```php
<td><button type='button' data-bs-toggle='modal' data-bs-target='#editModal' class='btn btn-primary edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
```

2. Then import the `data-eid` id to `index.php` file based on button click 

```php
$(document).on("click", ".edit-btn", function(){
let editBtnId = $(this).data('eid');
})
```

3. The send this data id for edit action to `edit-data.php` file by ajax

in this file for two different html data we put two different variable in `$tableBody = "";` & `$tableFooter = "";`

then edited value send to `index.php` file 

```php
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
```

in `index.php` file this two html payload receive and put into specific html div by ajax and shown in modal

```php
// if edit button clicked, then send edit button id to "edit-data.php" and receive button id data and html payload
$.ajax({
    url: "edit-data.php",
    type: "POST",
    data: {id: editBtnId},
    success: function(data){
        // Split the response into body and footer HTML using the delimiter "|||"
        let [tableBody, tableFooter] = data.split("|||");

        $('#modal-body table').html(tableBody);
        $('#modal-footer').html(tableFooter);
        
    }
})
```


## Change the value, make it update in database and show the value
4. Then get edit data value from `edit-data.php` by ajax

```php
// get edited data
$(document).on("click", "#edit-submit", function(){
    let updateBtnId = $("#update-id").val();
    let fname = $("#edit-fname").val();
    let lname = $("#edit-lname").val();
});
```

And then send the edited data to `update-data.php` file for update action 

5. If the `update-data.php` successfully work then make update data in table and close the modal
```php
// update function
$.ajax({
    url: "update-data.php",
    type: "POST",
    data: {id: updateBtnId, first_name: fname, last_name: lname},
    success: function(data){
        if(data == 1){
            $("#editModal").modal('hide');
            // after update we need to initiate our loadTable() function to make update the shown data
            loadTable();
        }
    }
});
```
