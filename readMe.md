## Ajax 
Asynchronous JavaScript and XML

To use Ajax we need Jquery. 

## Ajax basic structure

```js

    $.ajax({
        url: "file.php", //this file have read, insert, update and delete actions
        type: "POST",
        data: string / array / Object,
        success: function(data){
            //.. ajax data
        }
    });
```

## Button Click load
We can use button to load data by button click. By this the data will not be available instantly. Like this, 
```php
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
```

## Function for fetch data 
We can use function to fetch data instantly. Like this, 
```php
$(document).ready(function(){
    function loadTable(){
        $.ajax({
            url: "display.php",
            type: "POST",
            success: function(data){
                $("#table-data").html(data);
            }
        });
    };

    loadTable(); //function call
});
```


## Resources 

[Yahoo Baba](https://www.youtube.com/playlist?list=PL0b6OzIxLPbxO0_8Av3c-9_l5RM5uJK8U)
