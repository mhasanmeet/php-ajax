<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP with Ajax</title>
</head>
<body>
    <table id="main" border="0" cellspacing=0>
        <tr>
            <td id="header">
                <h1>PHP with Ajax</h1>
            </td>
        </tr>

        <tr>
            <td id="table-load">
                <input type="button" value="Load Data" id="load-button">
            </td>
        </tr>

        <tr>
            <td id="table-data">
                <!-- <table border="1" width="100%" cellspacing="0" cellpadding="10px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td>Mahmudul Hasan</td>
                    </tr>
                </table> -->
            </td>
        </tr>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#load-button").on("click", function(e){
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data){
                        $("#table-data").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>