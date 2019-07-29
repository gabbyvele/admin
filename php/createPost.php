<?php
    include('conn.php');

    $target_dir = "../../images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $postCompany = $_POST['postCompany'];
    $postSubject = $_POST['postSubject'];
    $fileName = $_POST['fileName'];
    $fileExtension = $_POST['fileExtension'];
    $postContent = $_POST['postContent'];

    if (strlen($postCompany) > 0 && strlen($postSubject) > 0 && strlen($fileName) > 0 && strlen($fileExtension) > 0 &&
        strlen($postContent) > 0) {

        $fileName = $fileName . "_" . date("Y-m-d-H:i:s") . "." . $fileExtension;
        $location = $target_dir . $fileName;
        move_uploaded_file($_FILES["SelectedFile"]["tmp_name"], $location);

        $sql = "INSERT INTO `posts` 
            (`POST`, `FILE`, `COMPANY_ID`, `USER_ID`, `ACTIVE`, `TYPE`, `SUBJECT`, `TIMESTAMP`) VALUES
            ('$postContent', '$fileName', $postCompany, '0', '1', '1', '$postSubject', CURRENT_TIMESTAMP);";


        if ($mysqli->query($sql) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
?>