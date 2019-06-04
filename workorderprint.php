<?php
session_start();

class WorkOrderCreate
{
    public $customerID;
    public $firstName;
    public $lastName;
    public $areaCode;
    public $phoneNumber;
    public $devicemodel;
    public $partSKU;
    public $repairSKU;
    public $html;

    public function __construct(){  
        // data coming from $_SESSION
        $customerID = $_SESSION['customerID'];
        // data is coming across via $_POST
        $deviceModel= $_POST['deviceList'];
        $repairSKU= $_POST['repairList'];
        $partSKU= $_POST['partList'];
        //connect  to the database 
        $mysqli = new mysqli("localhost", "root", "", "twintechrepair");
          if ($mysqli->connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli->connect_error;
          }
        //-query  the database table 
        $sqli="SELECT firstName, lastName, areaCode, phoneNumber FROM customer WHERE customerID LIKE '%" . $customerID . "%'"; 
        //-run  the query against the mysql query function 
        $result= $mysqli->query($sqli);
        //-create  while loop and loop through result set 
        while($row = $result->fetch_assoc()){ 
                            $firstName  =$row['firstName']; 
                            $lastName=$row['lastName'];
                            $areaCode = $row['areaCode'];
                            $phoneNumber = $row['phoneNumber'];
                            
            
                          $this->html .= "";
                		  $this->html .= "<div>";
                		  $this->html .= "<h1>Work Order for:</h1>";
                		  $this->html .= "<ul>\n";
                          $this->html .= "<li>"  .$firstName . " " . $lastName .  "</li>\n";
                          $this->html .= "<li>"  . $areaCode . "-" . $phoneNumber . "</li>\n";
                		  $this->html .= "</ul>";
                          $this->html .= "</div>";
                          $this->html .= "<div>";
                          $this->html .= "<p>Device: " . $deviceModel ."</p>";
                          $this->html .= "<p>Repair Type: " . $repairSKU ."</p>";
                          $this->html .= "<p>Part Used: " . $partSKU ."</p>";
                          
            } 
         
      }
      function render(){
		print($this->html);
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
		   $customerList = new WorkOrderCreate();
		   $customerList->render();
           ?>
           <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
            onclick = "window.location.href = 'workordernewcustcreate.php';">New Customer</button>
            <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
            onclick = "window.location.href = 'searchcustomer.php';">Use Existing Customer</button>
            <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top"
            onclick = "window.location.href = 'index.php';">Home</button>

        </div>    
        
            
    </body>
</html>