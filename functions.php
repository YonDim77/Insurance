<?php


function connectServer() {

   $con = mysqli_connect("localhost", "stepsoft_admin", "desibug82", "stepsoft_insurance");
   if(!$con)
     {
     die('Could not connect: ' . mysqli_error($con));
     }
   
   mysqli_select_db($con, "stepsoft_insurance");
   
   
   mysqli_query($con, "SET CHARACTER SET utf8");
   
   return $con;
}


/*function connectServer() {
    
    $servername = "localhost";
    $username = "stepsoft_admin";
    $password = "desibug82";
    
    try {
        $conn = new PDO("mysql:host=$servername; dbname=stepsoft_insurance", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        
        $sql = "SET CHARACTER SET utf8";
        // use exec() because no results are returned
        $conn->exec($sql);
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
        
        return $con;
}

*/

//$conn = null;

?>

