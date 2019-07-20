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

        <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">

        <script type="text/javascript" src="public/lib/jquery/jquery.js"></script>
        <script type="text/javascript" src="public/lib/bootstrap/js/bootstrap.js"></script>
    </head>
    <body class="container">
        <div id="help">
            <p>CSV To INSERT SQL</p>
        </div>
        <form method="post" action="main/processing.php" enctype="multipart/form-data">
            <img src="imgs/outil_description.png" alt="help" id="helpText"/>
            <!----- NOM DE LA TABLE ----->
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="tableName">Nom de la table</label>
                    </div>
                    <input class="form-control" type="text" name="tableName" id="tableName" required/>
                </div>
            </div>
            <!----- SEPARATEUR ----->
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="separator">
                            Choisir le séparateur dans votre fichier
                        </label>
                    </div>
                    <select class="custom-select" name="separator" id="separator">
                        <option value="" selected>...</option>
                        <option value=";">; point virgule</option>
                        <option value=",">, virgule</option>
                    </select>
                </div>
            </div>
            <!----- IMPORT FICHIER ----->
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input class="custom-file-input" 
                            aria-describedby="inputGroupFileAddon01" 
                            type="file" name="file" id="file" size="5000"/>
                        <label class="custom-file-label" for="file" >Fichier csv</label>
                    </div>
                </div>
            </div>
            <!----- CONTENU FICHIER ----->
            <div class="form-group">
                <label for="fileContent">Ou copiez ici le contenu</label>
                <textarea class="form-control" id="fileContent" name="fileContent" rows="15" cols="100">
                </textarea>
            </div>
            <!----- BUTTON ----->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm btn-block" name="valider">
                    Valider
                </button>
            </div>
        </form>

        <!----- DOWNLOAD BLOC ----->
        <div id="downloadBloc">
            <!----- MSG ERREUR ----->
            <?php if ($erreur != null) { ?>
                <div class="modal" id="errorModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id="message"><?php echo $erreur; ?></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($done == 1) { ?>
                <div class="modal" id="downloadModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id="message">Fichier sql créer</p>
                                <form method="post" action="main/download.php">
                                    <p>Télécharger le fichier sql?</p>
                                    <input type="hidden" name="fileName" id="fileName" value=<?php echo $fileName; ?> />
                                    <button type="submit" name="confirm" id="btYes" value="1">Oui</button>
                                    <button type="submit" name="confirm" id="btNo" value="0">Non</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <script src="public/js/js_file.js"></script>
        <?php if ($erreur != null) { ?>
            <!--------- Show error modal Message ---------->
            <script type="text/javascript">
                showErrorModal();
            </script>
        <?php } else if ($done == 1) { ?>
            <script type="text/javascript">
                showDownloadModal();
            </script>
        <?php } ?>
    </body>
</html>
