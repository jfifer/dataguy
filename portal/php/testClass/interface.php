<?php
require_once('../MAIN_CONFIG.php');
class Customer {
    
  
    public $mysqli;

    public function __constructor() {
        //$this->mysqli = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
        // $conn = new mysqli($HOST, $DBUSER, $DBPWD, $DBNAME);
    }
    
    public function customerCount() {
    
        global $HOST,$DBUSER,$DBNAME,$DBPWD;
        
        $conn = new mysqli($HOST, $DBUSER, $DBPWD, $DBNAME);
        $sql="select count(*) from customer where statusId in (2,3)"; 
         
        if ($result=mysqli_query($conn,$sql) ) {
             while ($row=mysqli_fetch_row($result)) {
                  $arrayData[] = $row;
             }
             $cleanData = json_encode($arrayData,JSON_NUMERIC_CHECK);
        }
        echo $cleanData;
	mysqli_close($conn);
   }
}

// $getCustomerCount = new Customer();
// $getCustomerCount->customerCount();

?>
