<?php

require dirname(__DIR__) . '/vendor/autoload.php';

/***** CLASS ******/
use Object\Factory;

$factory = new Factory(
	filter_input(INPUT_POST, "fileContent"),
	filter_input(INPUT_POST, "tableName"),
	filter_input(INPUT_POST, "separator"),
	$_FILES["file"]["tmp_name"],
	$_FILES["file"]["name"]
);

$factory->checkValues();

////////// TOUT REFAIRE ////////////

/**
 * @todo make it to be able to transform more than one file per process
 * 
 */

// create sql from imported file
if ($factory->fileName != '') {
	$factory->getContentFromFile();
}

$factory->createTab();
$factory->generateSqlInsert();

$fileName = $factory->generateSqlFile();

header("location:../index.php?done=1&fileName=$fileName");
