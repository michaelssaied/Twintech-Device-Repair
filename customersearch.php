<?php 
	  
class CustomerSearch
{
	public $html;


	public function __construct(){  
      if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){ 
	  $name=$_POST['name']; 
	  //connect  to the database 
	  $mysqli = new mysqli("localhost", "root", "", "twintechrepair");
        if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }
	  //-query  the database table 
	  $sqli="SELECT customerID, firstName, lastName, areaCode, phoneNumber FROM customer WHERE firstName LIKE '%" . $name .  "%' OR lastName LIKE '%" . $name ."%' OR phoneNumber LIKE '%" . $name ."%'"; 
	  //-run  the query against the mysql query function 
	  $result= $mysqli->query($sqli);
	  //-create  while loop and loop through result set 
	  while($row = $result->fetch_assoc()){ 
	          $firstName  =$row['firstName']; 
	          $lastName=$row['lastName'];
              $areaCode = $row['areaCode'];
              $phoneNumber = $row['phoneNumber'];
			  $customerID=$row['customerID']; 
			  
			  $this->html .= "";
			  $this->html .= "<div>";
			  $this->html .= "<p>Please click the customer to create a new work order.";
			  $this->html .= "<ul>\n";
			  $this->html .= "<li>" . "<a href = 'createworkorderexistcustomer.php?id=$customerID'>" .$firstName . " " . $lastName .  " ". $areaCode . "-" . $phoneNumber . "</a></li>\n";
			  $this->html .= "</ul>";
			  $this->html .= "</div>";
	  	} 
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
           <p>
		   <?php
		   $customerList = new CustomerSearch();
		   $customerList->render();
		   ?>
		   </p>

        </div>    
        
            
    </body>
</html>