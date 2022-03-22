<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM countries WHERE name = '".$_POST['username']."'";
$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);

//        if($_REQUEST['email'] == "farukhaidar3@gmail.com"){
//        if($_POST['email'] != "farukhaidar3@gmail.com"){
//            echo "true";
//        }else{
//            echo "false";
//        }


if ($count_rows < 0)
{
  echo "false";
}
else
{
    echo "true";
}


