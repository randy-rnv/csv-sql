<?php
    $message = filter_input(INPUT_GET, "message");
    $fileName = filter_input(INPUT_GET, "fileName");
    
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .hidden{
                display: none;
            }
        </style>
    </head>
    <body>
        <form method="post" action="controls/processing.php" enctype="multipart/form-data">
            <label for="tableName">Nom de la table dans votre bd</label>
            <input type="text" name="tableName" id="tableName" required/>
            <br/>
            <label for="separator">Choisir le séparateur dans votre fichier</label>
            <select name="separator" id="separator">
                <option value="">Choisir</option>
                <option value=";">; point virgule</option>
                <option value=",">, virgule</option>
            </select>
            <br/>
            <label for="file" >Fichier csv</label>
            <input type="file" name="file" id="file" size="5000"/>
            <br/>
            <label for="fileContent">Ou copiez ici le contenu</label>
            <br/>
            <textarea id="file" name="fileContent" rows="20" cols="100"></textarea>
            <br/>
            <input type="submit" name="valider" />
        </form>
         <div id="downloadBloc">
        <?php   if($message){ ?>
       
        <p id="message">Fichier sql créer</p>
        <form method="get" action="controls/download.php">
            <p>Télécharger le fichier sql?</p>
            <input type="hidden" name="fileName" id="fileName" value=<?php echo $fileName; ?> />
            <input type="submit" name="confirm" id="btYes" value="oui"/>
            <input type="submit" name="confirm" id="btNo" value="non"/>
        </form>
       
        <?php } ?>
         </div>
        
        <script src="js/jquery.js"></script>
        <script src="js/jsFile.js"></script>
    </body>
</html>
