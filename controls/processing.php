<?php

require_once '../functions/csv_to_sqlInsert_function.php';

$fileContent = filter_input(INPUT_POST, "fileContent");
$table = filter_input(INPUT_POST, "tableName");
$separator = filter_input(INPUT_POST, "separator");
$btValider = filter_input(INPUT_POST, "valider");
$file = $_FILES["file"]["tmp_name"];
$fileName = $_FILES["file"]["name"];

verification($fileName, $fileContent, $separator);

if ($fileContent) {
    fopen("../csv_file/file.csv", "w");
    file_put_contents("../csv_file/file.csv", $fileContent);

    $reqArray = csvToReqSql("../csv_file/file.csv", $table, $separator); //récupération des requêtes
    sqlFile("../sql_files/$table.sql", $reqArray); // procédure de création du fichier sql
    header("location:../index.php?message=1&fileName=$table");
} // if($fileContent)

if ($fileName) {
    $reqArray = csvToReqSql($file, $table, $separator); //récupération des requêtes
    sqlFile("../sql_files/$table.sql", $reqArray); // procédure de création du fichier sql
    header("location:../index.php?message=1&fileName=$table");
}// if($fileName)

?>

