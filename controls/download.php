<?php
    $fileName = filter_input(INPUT_GET, "fileName");
    $btConfirm = filter_input(INPUT_GET, "confirm");
    
    if($btConfirm == "oui"){
        header("location:../sql_files/$fileName.sql");
//        unlink("../sql_files/$fileName.sql");
    }else{
        unlink("../sql_files/$fileName.sql");
        header("location:../index.php");
    }
?>

