<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_POST['submit'])){
        $mysqli=new mysqli('localhost','root','','users') or die(mysqli_error($mysqli2));
        $mysqli2=new mysqli('localhost','root','','history') or die(mysqli_error($mysqli2));

        $sender=$_POST['enterSName'];
        $receiver=$_POST['enterName'];
        $amt=$_POST['enterAmount'];

        $sql="UPDATE user SET balance=balance-'$amt' WHERE email='$sender'";
        $sql3="UPDATE user SET balance=balance+'$amt' WHERE email='$receiver'";
        $sql2="INSERT INTO histories (sender, receiver, amt, dt) VALUES ('$sender','$receiver','$amt',current_timestamp())";

        $mysqli->query($sql) or die($mysqli->error);
        $mysqli->query($sql3) or die($mysqli->error);
        $mysqli2->query($sql2) or die($mysqli2->error);

        $_SESSION['message']="Transaction Sucessful";

        header('Location: customer.php');
    };
?>