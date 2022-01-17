<?php

const SCRIPT_DIR = __DIR__.'/../affiche';
const UPLOAD_DIR = SCRIPT_DIR.'/camera';

if($_FILES["camera"]['type'] != 'image/png' || mime_content_type($_FILES["camera"]['tmp_name']) != 'image/png') {
    echo "Ce format de fichier n'est pas autorisé";
    exit(1);
}

if(!is_writable(UPLOAD_DIR)) {
    echo "Le dossier d'upload n'est pas autorisé en écriture";
    exit(1);
}

move_uploaded_file($_FILES["camera"]["tmp_name"], UPLOAD_DIR."/".$qrcode.".png");

header('Location: resultat.php?csv='.$_GET['csv']);
