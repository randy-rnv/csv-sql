<?php
$done       = filter_input(INPUT_GET, "done");
$erreur     = filter_input(INPUT_GET, "erreur");
$fileName   = filter_input(INPUT_GET, "fileName");
?>

<!DOCTYPE html>
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
        <div id="help">
            <p>Un petit outil qui permet de transformer le contenu de vos fichiers .csv en requête d'insertion dans une table</p>
        </div>
        <form method="post" action="main/processing.php" enctype="multipart/form-data">
            <img src="imgs/outil_description.png" alt="help" id="helpText"/>
            <label for="tableName">Nom de la table</label>
            <input type="text" name="tableName" id="tableName" required/>
            <br/>
            <label for="separator">Choisir le séparateur dans votre fichier</label>
            <select name="separator" id="separator">
                <option value="">Choisir</option>
                <option value=";" selected>; point virgule</option>
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
            <?php if ($erreur) { ?>
                <p id="message"><?php echo $erreur; ?></p>
            <?php } ?>

            <?php if ($done == 1) { ?>

                <p id="message">Fichier sql créer</p>
                <form method="post" action="main/download.php">
                    <p>Télécharger le fichier sql?</p>
                    <input type="hidden" name="fileName" id="fileName" value=<?php echo $fileName; ?> />
                    <button type="submit" name="confirm" id="btYes" value="1">Oui</button>
                    <button type="submit" name="confirm" id="btNo" value="0">Non</button>
                </form>

            <?php } ?>
        </div>

        <script src="public/js/lib/jquery.js"></script>
        <script src="public/js/js_file.js"></script>
    </body>
</html>
