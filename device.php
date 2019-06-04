<?php

class CreateNewDevice
{
    public $deviceModel;
    public $deviceName;

    function __construct()
    {

    $this->databaseName = "twintechrepair";
        $this->password     = "";
        $this->server       = "localhost";
        $this->username     = "root";
        
        
        $this->dbConnection = new mysqli($this->server, $this->username, $this->password, $this->databaseName);
        
        if ($this->dbConnection->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->dbConnection->connect_error;
        }
    }
    
    function InsertDeviceData()
    {
        // data is coming across via $_POST
        $deviceModel= $_POST['deviceModel'];
        $deviceName= $_POST['deviceName'];
        // Prepare your insert SQL statement
        $sql = "INSERT into `device` (deviceModel, deviceName) VALUES (?, ?)";
        $preparedStatement = null;
        if (!$preparedStatement = $this->dbConnection->prepare($sql)) {
            print("$preparedStatement->error");
        }
        
        if (!$preparedStatement->bind_param("ss", $deviceModel, $deviceName)) {
            print($preparedStatement->error);
        }
        
        // Execute your bound and prepared statement
        if (!$preparedStatement->execute()) {
            print($preparedStatement->error);
        }
            echo "You have successfully registered!";
    }
    
}

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
            New Devices
        </title>
    </head>
    <body>
        <?php
        require_once ('navbar.php');
        $navbar = new NavBar();
		$navbar->render();
        ?>  
        <p>     
        <?php
        $newPart = new CreateNewDevice();
        $newPart->InsertDeviceData();
        ?>
        </p>   
        <button class = "w3-button w3-black w3-padding-large w3-large w3-margin-top"
        onclick = "window.location.href = 'createdevice.php';">Add Another Device</button>
        <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
        onclick = "window.location.href = 'index.php';">Home</button>
    </body>
</html>