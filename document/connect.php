<?php

$user = 'root';
$pass = '';
$db = 'Cards';
$con = mysqli_connect ('localhost', $user, $pass, $db) or die("whoops");
echo "Here!";




// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM Items ";
$result=mysqli_query($con,$sql);

// Fetch all
mysqli_fetch_all($result,MYSQLI_ASSOC);
 while ($row=mysqli_fetch_all($result))
    {
    printf ("%s (%s)\n",$row[0],$row[1]);
    }
// Free result set
mysqli_free_result($result);
  




$rdb_value = $_POST['MyRadio'];
echo $rdb_value;

mysqli_close($con);
?>

