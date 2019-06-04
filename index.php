<?php
session_start();



?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
        <title>
            Home
        </title>
    </head>
    <body>
        <?php
        require_once ('navbar.php');
        $navbar = new NavBar();
		$navbar->render();
        ?>    
        <div>  
            <h1> Create a new work order?</h1>
            <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
            onclick = "window.location.href = 'workordernewcustcreate.php';">New Customer</button>
            <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
            onclick = "window.location.href = 'searchcustomer.php';">Use Existing Customer</button>

        </div>    
        
            
    </body>
</html>