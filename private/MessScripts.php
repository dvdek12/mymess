<?php

function showConversations($userId,$conn){

        $sql = "SELECT id_sender, ifRead FROM conversations 
                WHERE id_user = '".$userId."'";

        if($result = @$conn->query($sql)){

            $howManyConv = $result->num_rows;

            if($howManyConv>0){
                while($row = $result->fetch_assoc()) {
                    $id = $row["id_sender"];
                    $sql = "SELECT name FROM users 
                    WHERE id = '".$id."'";
    
                    if($result1 = @$conn->query($sql)){
    
                        $howManyConv2 = $result1->num_rows;
        
                        if($howManyConv2>0){
                            $name = $result1->fetch_assoc()["name"];

                            echo '
                            <div class="flex flex-row space-x-4 items-center">
                                <img src="profPics/'.profPicPath($id,$conn).'" alt="" class="w-8 h-8">
                                <div class="p-1 w-64 md:w-auto h-12 rounded-lg
                                    bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 ">
                                <div class="bg-blue-400 h-full w-full rounded-md py-2 px-2 font-bold text-white ">
                                <form action="mymess.php" method="post"><button name="what" value="'.$id.'">
                                '.$name.'
                                </button><input type="hidden" name="name" value="'.$name.'"></form>
                                </div>
                                </div>
                            </div>              
                            ';
                        }
                    }
                }
            }


        }

} 


function showMessages($receiverId,$senderId,$conn){

    
        $sql = "SELECT id_sender, id_receiver, text FROM messages
                WHERE id_sender = '".$senderId."' AND id_receiver = '".$receiverId."'
                OR id_sender = '".$receiverId."' AND id_receiver = '".$senderId."'";

        if($result = @$conn->query($sql)){

            $howManyRows = $result->num_rows;

            if($howManyRows>0){
                while($row = $result->fetch_assoc()) {
                    if($row["id_sender"]==$senderId){

                        echo '
                        <div class="inline-flex items-center space-x-3">
                        <img src="profPics/'.profPicPath($senderId,$conn).'" alt="" class="w-8 h-8 self-start">
                        <div class="w-auto p-4 bg-gray-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                            <p class="text-sm">'.$row["text"].'</p>
                        </div>
                        </div>
                        
                        ';

                    }
                    else 
                    {
                        echo '
                        <div class="inline-flex items-center space-x-3 place-self-end"> <!-- prawa -->
                        <div class="w-auto p-4 bg-purple-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                            <p class="text-sm">'.$row["text"].'</p>
                        </div>
                        <img src="profPics/'.profPicPath($receiverId,$conn).'" alt="" class="w-8 h-8 self-start">
                        </div>
                        ';

                    }
                  }
            }
        }
        return $howManyRows;
}

function updateIfRead($ifRead,$userId,$senderId,$conn){

    $sql = "UPDATE conversations SET ifRead = '".$ifRead."' WHERE id_user='".$userId."' AND id_sender='".$senderId."'";
    $conn->query($sql);
}

function addConversation($userId,$senderId,$conn){

    $sql = "SELECT * FROM conversations WHERE id_user='".$userId."' AND id_sender='".$senderId."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows==0){
            $sql = "INSERT INTO conversations (id_user, id_sender, ifRead) VALUES ('".$userId."', '".$senderId."', 1)";
            $conn->query($sql);
        }
    }
}

function profPicPath($userId,$conn){

    $sql = "SELECT prof_pic FROM users WHERE id='".$userId."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            return $row["prof_pic"];
            
        }
    }
}

function addFriend($code, $user, $conn){
    $sql = "SELECT id FROM users WHERE code='".$code."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            addConversation($user,$row["id"],$conn);
            addConversation($row["id"],$user,$conn);
            
        }
    }
}

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


