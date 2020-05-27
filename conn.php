<?php
/*  $local_host="127.0.0.1";
  $user_host="root";
  $pass_host='';
*/  
//  $conn = mysqli_connect($local_host, $user_host, $pass_host);
	$con = mysqli_connect("127.0.0.1","root","","automation") or die("Some error occurred during connection " . mysqli_error($con));
	mysqli_set_charset($con,"utf8");
/*  
  if (!$conn) {
      echo "Connect fail";
  }
  else {
      $databse = mysql_select_db("random_data", $conn);
      if (!$databse) {
          echo "Not find database!";
          exit();
      }
  }
*/
?>