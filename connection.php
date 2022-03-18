<?php
$con  = new mysqli('localhost','root','','alquran_app');
if($con){
//    echo 'Database Connection';
}else
{
    echo 'Database Connection Error';
}