<?php
    include('conn.php');

    $target_dir = "../../images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $skipImageCheck = $_POST['skipImageCheck'];
    $postContent = $_POST['postContent'];
    $postSubject = $_POST['postSubject'];
    $postID = $_POST['postID'];

    if (strlen($skipImageCheck) > 0 && strlen($postContent) > 0 && strlen($postSubject) > 0 && strlen($postID) > 0) {
        $sql = "w', `SUBJECT` = '$postSubject' WHERE `posts`.`ID` = $postID;";

        if ($skipImageCheck == "false") {
            $fileName = $_POST['fileName'];
            $fileExtension = $_POST['fileExtension'];
            $fileName = $fileName . "_" . date("Y-m-d-H:i:s") . "." . $fileExtension;
            $location = $target_dir . $fileName;

            move_uploaded_file($_FILES["SelectedFile"]["tmp_name"], $location);

            $sql = "UPDATE `posts` SET `POST` = '$postContent', `FILE` = '$fileName', `SUBJECT` = '$postSubject' 
                WHERE `posts`.`ID` = $postID;";
        }

        if ($mysqli->query($sql) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else {
        echo strlen($skipImageCheck);
    }
?>