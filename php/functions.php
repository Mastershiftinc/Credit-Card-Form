<?php

include( 'config.php' );
class User extends dbConfig {
  protected $hostName;
  protected $userName;
  protected $password;
  protected $dbName;
  private $userTable = 'transactions';  
  private $dbConnect = false;
  public function __construct() {
    if ( !$this->dbConnect ) {
      $database = new dbConfig();
      $this->hostName = $database->serverName;
      $this->userName = $database->userName;
      $this->password = $database->password;
      $this->dbName = $database->dbName;
      $conn = new mysqli( $this->hostName, $this->userName, $this->password, $this->dbName );
      if ( $conn->connect_error ) {
        die( "Error failed to connect to MySQL: " . $conn->connect_error );
      } else {
        $this->dbConnect = $conn;
      }
    }
  }

  private function getData( $sqlQuery ) {
    $result = mysqli_query( $this->dbConnect, $sqlQuery );
    if ( !$result ) {
      die( 'Error in query: ' . mysqli_error() );
    }
    $data = array();
    while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
      $data[] = $row;
    }
    return $data;
  }
  private function getNumRows( $sqlQuery ) {
    $result = mysqli_query( $this->dbConnect, $sqlQuery );
    if ( !$result ) {
      die( 'Error in query: ' . mysqli_error() );
    }
    $numRows = mysqli_num_rows( $result );
    return $numRows;
  }   


//getting 

//function
public function send() {
  
    $select = mysqli_query($this->dbConnect, "SELECT cardnumber FROM " . $this->userTable . " WHERE cardnumber = '".$_POST["creditcard"]."'");
 if(mysqli_num_rows($select)) { 
    echo("<script>window.location = 'https://mastershift.net/tutorials/files/creditcard/transactions';</script>");
    
    

   
}else if($_POST["creditcard"] !=''){

  $n=11;
  function getRandomString($n) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
    
      for ($i = 0; $i < $n; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $randomString .= $characters[$index];
      }
    
      return $randomString;
  }
    
  $transactionId = getRandomString($n);



    $sql = "INSERT INTO " . $this->userTable . " (cardnumber,cardname,month,year,cardcvv,cardtype,transactionid)VALUES('".$_POST["creditcard"]."','".$_POST["cardname"]."','".$_POST["month"]."','".$_POST["year"]."','".$_POST["cardcvv"]."','".$_POST["cardType"]."','".$transactionId."') ";
            
    if ($this->dbConnect->query($sql) === TRUE) {} 
    else {
        echo "Error: " . $sql . "<br>" . $this->dbConnect->error;
        $this->dbConnect->close();
        
        }        
       
        
        echo("<script>window.location = 'https://mastershift.net/tutorials/files/creditcard/transactions';</script>");
    
    }

  }

//getting the transactions
  public function transactions() {
    $sqlQuery = "SELECT * FROM " . $this->userTable . "   ";
    $resultSet = mysqli_query( $this->dbConnect, $sqlQuery );
    $isValidLogin = mysqli_num_rows( $resultSet );
    
    if ( $isValidLogin ) {
        
        if($result = $this->dbConnect -> query($sqlQuery)){
        
         while ($users = $result->fetch_assoc()) {
           
            $cardnumber = $users["cardnumber"];
            $cardname = $users["cardname"];
            $month = $users["month"];
            $year = $users["year"];
            $cardcvv = $users["cardcvv"];
            $cardtype = $users["cardtype"];
            $transactionId = $users["transactionid"];

            //display the last four digits of a credit card
           $lastfour =  str_replace(range(0,9), "*", substr($cardnumber, 0, -4)) .  substr($cardnumber, -4);

         //displaying the creditcard records
           echo '
          
    <tr class="data"  >
      <td class="datainfo" >'.$transactionId.'</td>
      <td class="datainfo" >'.$lastfour.'</td>
      <td class="datainfo" >'.$cardname.'</td>
      <td class="datainfo" >'.$month.'/'.$year.'</td>
      <td class="datainfo" >'.$cardcvv.'</td>
      <td class="datainfo" >'.$cardtype.'</td>
    </tr>
   
          
           ';


         }
        }
    }
  }
















}
	
?>
