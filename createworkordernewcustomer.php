<?php
session_start();

class CreateNewCustomerWO
{
    public $firstName;
    public $lastName;
    public $areaCode;
    public $phoneNumber;
    
        
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
    
    function InsertCustomerData()
    {
        // data is coming across via $_POST
        $firstName= $_POST['firstName'];
        $lastName= $_POST['lastName'];
        $areaCode= $_POST['areaCode'];
        $phoneNumber= $_POST['phoneNumber'];
        // Prepare your insert SQL statement
        $sql = "INSERT into `customer` (firstName, lastName, areaCode, phoneNumber) VALUES (?, ?, ?, ?)";
        $preparedStatement = null;
        if (!$preparedStatement = $this->dbConnection->prepare($sql)) {
            print("$preparedStatement->error");
        }
        
        if (!$preparedStatement->bind_param("ssss", $firstName, $lastName, $areaCode, $phoneNumber)) {
            print($preparedStatement->error);
        }
        
        // Execute your bound and prepared statement
        if (!$preparedStatement->execute()) {
            print($preparedStatement->error);
        }else{
            $sql = "SELECT customerID FROM  customer WHERE firstName=? AND lastname=?";
            if (!$preparedStatement = $this->dbConnection->prepare($sql)) {
                print("$preparedStatement->error");
            }
            
            if (!$preparedStatement->bind_param("ss", $firstName, $lastName)) {
                print($preparedStatement->error);
            }
            if (!$preparedStatement->execute()) {
                print($preparedStatement->error);
            }else{
                // store result for checking against
                $preparedStatement->store_result();

                // bind result to variable.
                $preparedStatement->bind_result($param_cust_id);

                while($preparedStatement->fetch()){
                    $_SESSION['customerID'] = $param_cust_id;
                }
 
            }

            echo "You have successfully posted!";
            
        }
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

        <?php
        $newPart = new CreateNewCustomerWO();
        $newPart->InsertCustomerData()
        ?>
        <p>Choose the appropriate fields.</p>
        <form action="workorderprint.php" method="POST">
                    <!-- Used to create a dynamic dropdownlist -->
                <?php

                print("Select Device");
                $mysqli = new mysqli("localhost", "root", "", "twintechrepair");
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                }
                $res = $mysqli->query("SELECT * FROM `device`");
                echo "<select name = 'deviceList'>";
                while($row = $res->fetch_assoc()) {
                    echo '<option value ="'.$row['deviceName'].'">'.$row['deviceName'].'</option>';
                }
                echo "</select><br>";
                ?>  

                    <!-- Used to create a dynamic dropdownlist -->
                <?php
                print("Select Repair Type");
                $mysqli = new mysqli("localhost", "root", "", "twintechrepair");
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                }
                $res = $mysqli->query("SELECT * FROM `repairType`");
                echo "<select name = 'repairList'>";
                while($row = $res->fetch_assoc()) {
                    echo '<option value ="'.$row['repairSKU'].'">'.$row['repairSKU'].'</option>';
                }
                echo "</select><br>";
                ?>   
                    <!-- Used to create a dynamic dropdownlist -->
                <?php
                print("Select Part");
                $mysqli = new mysqli("localhost", "root", "", "twintechrepair");
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                }
                $res = $mysqli->query("SELECT * FROM `parts`");
                echo "<select name = 'partList'>";
                while($row = $res->fetch_assoc()) {
                    echo '<option value ="'.$row['partSKU'].'">'.$row['partSKU'].'</option>';
                }
                echo "</select><br>";
                ?>   
                <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top" type="submit" name="submit">Create</button>
        </form>
        </div>    
        
            
    </body>
</html>