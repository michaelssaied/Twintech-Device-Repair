<?php
class NavBar 
{
    public $html;
    
    public function __construct() {
        $this->html = "";
        $this->html .= "<div class='w3-bar w3-red w3-card w3-left-align w3-large'>";
        $this->html .= "<a class='w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red' href='javascript:void(0);' onclick='myFunction()'' title='Toggle Navigation Menu'><i class='fa fa-bars'></i></a>";
        $this->html .= "<a href='index.php' class='w3-bar-item w3-button w3-padding-large w3-white'>Home</a>";
        $this->html .= "<a href='createcustomer.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Customers</a>";
        $this->html .= "<a href='createdevice.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Devices</a>";
        $this->html .= "<a href='createpart.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Parts</a>";
        $this->html .= "<a href='createrepair.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Repairs</a>";
        $this->html .= "</div>";
    }
    
    public function render() {
        print($this->html);
    }
}




?>