<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <table id="main" border='0' cellspacing="0">
        <tr>
            <td id="header">
                <h1>Add Record with PHP and Ajax</h1>
            </td>
        </tr>

        <tr>
            <td id="table-form">
                <form id="clearForm">
                    First Name: <input type="text" id="fname"> 
                    Last Name: <input type="text" id="lname">
                    <input type="submit" id="save-data" value="Save">
                </form> 
            </td>
        </tr>

        <tr>
            <td id="table-data">
            </td>
        </tr>
    </table>

    <div id="error-message"></div>
    <div id="success-message"></div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <table>
                        <!-- the table data will came from "edit-data.php" file -->
                    </table>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <!-- the button data will came from "edit-data.php" file -->
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Show data function
        function loadTable(){
            $.ajax({
                url: "display-data.php",
                type: "POST",
                success: function(data){
                    $("#table-data").html(data);
                }
            });
        };
        loadTable();


        // Insert data
        $("#save-data").on("click", function(e){
            // remove submit form default behavior
            e.preventDefault();
            var fname = $("#fname").val();
            var lname = $("#lname").val();

            // check if input field is blank
            if(fname == "" || lname == ""){
                $("#error-message").html("All fields are required").slideDown();
                $("#success-message").slideUp();
            }else{
                $.ajax({
                    url: "insert-data.php",
                    type: "POST",
                    // insert data as object
                    data: {first_name: fname, last_name: lname},
                    success: function(data){
                        if(data == 1){
                            loadTable();

                            // clear form input data
                            $("#clearForm").trigger("reset");
                            $("#success-message").html("Data inserted successfully").slideDown();
                            $("#error-message").slideUp();
                        }else{
                            $("#error-message").html("Can't Save Records").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                });
            }
        })


        // Delete data function
        $(document).on("click", ".delete-btn", function(){
            // confirm alert for delete column data
            if(confirm("Do you really want to delete this data column?")){
                // here we get id from delete button id which is fetch from database column id number
                let deleteBtnId = $(this).data("id");
                let thisElm = this;
                
                $.ajax({
                    url: "delete-data.php",
                    type: "POST",
                    data: {id: deleteBtnId},
                    success: function(data){
                        if(data == 1){
                            $(thisElm).closest("tr").fadeOut();
                        }else{
                            $("#error-message").html("Can't delete the data").slideDown();
                        }
                    }
                });
            }
        });


        // Edit data function
        $(document).on("click", ".edit-btn", function(){
            let editBtnId = $(this).data('eid');

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

            // get edited data
            $(document).on("click", "#edit-submit", function(){
                let updateBtnId = $("#update-id").val();
                let fname = $("#edit-fname").val();
                let lname = $("#edit-lname").val();

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
            });
        });

    });
</script>
</body>
</html>