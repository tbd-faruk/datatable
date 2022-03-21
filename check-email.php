<?php
//        if($_REQUEST['email'] == "farukhaidar3@gmail.com"){
//        if($_POST['email'] != "farukhaidar3@gmail.com"){
//            echo "true";
//        }else{
//            echo "false";
//        }


if (!empty($_POST['email']))
{
    if($_POST['email'] != "farukhaidar3@gmail.com")
    {
        echo "true";  //good to register
    }
    else
    {
        echo "false"; //already registered
    }
}
else
{
    echo "false"; //invalid post var
}
?>