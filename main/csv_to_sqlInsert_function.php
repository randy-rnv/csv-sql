<?php

/* * ***************************** function csvToReqSql *************************************** */

//main function
function csvToReqSql($file, $tableName, $separator = ",") { /* * ********* Création des requêtes sql ********* */
    $fichier = $file;
    $canal = fopen($fichier, "r"); //ouverture du fichier "personnages.txt", type d'ouverture "r"
    $i = 0; // compteur pour chaque ligne du fichier

    $reqArray = array();

    while (!feof($canal)) { // On commence par la première ligne
        $ligne = trim(fgets($canal)); // Lecture d'une ligne

        if ($ligne != "") {
            $tab = explode($separator, $ligne); // explode dépend du séparateur dans le fichier .csv   

            if ($i == 0) {
                $column = implode(",", $tab); // fusionne $tab avec des "," pour former la liste des colonnes de la table
                $reqInsert = "INSERT INTO $tableName($column)";
            } else {
                $reqValues = getValues($tab);
            }// if else

            if ($i > 0) {
                $finalReq = $reqInsert . $reqValues . ";\n"; // Mise en place de la requête complète
                $reqArray[] = $finalReq;
            }// if

            $i++;
        } // if($ligne != "")
    }// while
    return $reqArray;   //retourne le tableau des requêtes final
}// function csvToReqSql

/* * ******************************************************************************************** */

/* * ******************************************** function sqlFile *********************************** */

/**
 * Création du fichier .sql
 * 
 * @param type $fileNameAndEmplacement
 * @param type $reqArray
 */
function sqlFile($fileNameAndEmplacement, $reqArray) { /* * ******* création du fichier sql *********** */
    $sqlFile = fopen($fileNameAndEmplacement, "w");
    $file = $fileNameAndEmplacement;
    file_put_contents($file, $reqArray);
}//function sqlFile

/* * ***************************************************************************************** */

function getValues($tab) {
    $reqValues = ""; // Variable qui contiendra la partie Values('valeur1', 'valeur2',...)
    $tabLength = count($tab);

    for ($k = 0; $k < $tabLength; $k++) { // ajout des '' pour chaque element à mettre dans VALUES
        $tab[$k] = "\"$tab[$k]\"";
    }

    $values = implode(",", $tab); // Mise en forme des valeurs pour VALUES
    $reqValues = "VALUES($values)";

    return $reqValues;
}// function getValues

function verification($fileName, $fileContent, $separator) {
    $erreur = "";

    if (!$separator) {
        $erreur .= "Choisir un séparateur et ";
    }

    if (!$fileName && !$fileContent) {
        $erreur .= "Veuillez importer un fichier ou copiez le contenu";
    }

    if (!$fileName && !$fileContent || !$separator) {
        header("location:../index.php?erreur=$erreur");
    }
}// function verification
?>

