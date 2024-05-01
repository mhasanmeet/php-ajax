<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // load data function from database 
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


            // Save button form remove default behavior
            $("#save-data").on("click", function(e){
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
        });
    </script>
</body>
</html>