<?php 
session_start();

if(isset($_SESSION["who"])){
    $receiverId = $_SESSION["who"];
    $senderId = $_SESSION["userId"];
    $howMany = $_SESSION["howMany"];

    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
        return false;
    }
    else
    {
        $sql = "SELECT id_sender, id_receiver, text FROM messages
        WHERE id_sender = '".$senderId."' AND id_receiver = '".$receiverId."'
        OR id_sender = '".$receiverId."' AND id_receiver = '".$senderId."'";

        if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howMany != $howManyRows)
            echo "nie git";
        else
            return false;
        }
    }
}
else return false;



?>