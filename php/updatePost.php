<?php
    include('conn.php');

    $postID = $_POST['postID'];
    $updateType = $_POST['updateType'];


    if ($updateType == "enable"){
        $sql = "UPDATE `posts` SET `ACTIVE` = '1' WHERE `posts`.`ID` = $postID;";
        if($mysqli->query($sql) == 1){
            echo "true";
        } else {
            echo "false";
        }
    }

    if ($updateType == "disable"){
        $sql = "UPDATE `posts` SET `ACTIVE` = '0' WHERE `posts`.`ID` = $postID;";
        if($mysqli->query($sql) == 1){
            echo "true";
        } else {
            echo "false";
        }
    }

    if ($updateType == "delete"){
        $sql = "DELETE FROM `posts` WHERE `posts`.`ID` = $postID;";
        if($mysqli->query($sql) == 1){
            echo "true";
        } else {
            echo "false";
        }
    }

?>
