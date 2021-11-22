<?php
session_start();

    require_once "connect.php";

    $conn1 = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($conn1->connect_errno!=0){
        echo "Error: ".$conn1->connect_errno;
        return false;
    }
    else
    {
    $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'".$_POST["text"]."')";

    $conn1 -> query($sql);

    $conn1 -> close();

    header("location: ../public/mymess.php");
    }

?>