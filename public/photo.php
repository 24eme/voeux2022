<?php

require __DIR__.'/config.inc.php'; 

if (!$_FILES["camera"] || (isset($_FILES["camera"]['error']) && $_FILES["camera"]['error'])) {
    echo "<p>Erreur lors de l'upload.</p>";
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    exit(2);
}

if($_FILES["camera"]['type'] != 'image/png' || mime_content_type($_FILES["camera"]['tmp_name']) != 'image/png') {
    echo "<p>Ce format (".$_FILES["camera"]['type'].") de fichier n'est pas autorisé.</p>";
    exit(1);
}

if(!is_writable(UPLOAD_DIR)) {
    echo "<p>Le dossier d'upload (".UPLOAD_DIR.") n'est pas autorisé en écriture.</p>";
    exit(1);
}

$number = sprintf("%03d", getLastPhotoFileNumber($csvId) + 1);

move_uploaded_file($_FILES["camera"]["tmp_name"], UPLOAD_DIR."/".$csvId."_".$number.".png");

header('Location: resultat.php?csv='.urlencode($csv).'&numero='.$number);
