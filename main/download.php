<?php
    $fileName	= filter_input(INPUT_POST, "fileName");
    $btConfirm	= filter_input(INPUT_POST, "confirm");

    $sql_file 	= '../tmp/'.$fileName;

    if($btConfirm == "1"){
        header('Content-Type: text/plain');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . $fileName . "\"");
        readfile("$sql_file");

        unlink("$sql_file");
    }else{
        unlink("$sql_file");
        header("location:../index.php");
    }
?>

