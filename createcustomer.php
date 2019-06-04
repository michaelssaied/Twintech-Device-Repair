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
            Create New Customer
        </title>


    </head>
    <body>
        <?php
        require_once ('navbar.php');
        $navbar = new NavBar();
		$navbar->render();
        ?>  
            <form action="customer.php" method="POST">
                First Name <input type="text" name="firstName"><br>
                Last Name: <input type="text" name="lastName"><br>
                Area Code: <input type="text" name="areaCode">
                Phone Number: <input type="text" name="phoneNumber"><br>
                <button 
                class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
                type="submit">Submit
                </button><br>
              </form>
        </form>
    </body>
</html>