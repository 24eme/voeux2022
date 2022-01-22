<?php

require __DIR__.'/config.inc.php'; 

if(!isset($_SERVER['QUERY_STRING']) || !preg_match("/^[a-z0-9]+$/", $_SERVER['QUERY_STRING'])) {
    echo "Code non renseigné ou invalide";
    exit(1);
}

if(!file_exists(DB_DIR."/".$_SERVER['QUERY_STRING'].".csv")) {
    echo "Ce code n'existe pas";
    exit(1);
}

$csv = file_get_contents(DB_DIR."/".$_SERVER['QUERY_STRING'].".csv");

if(getLastPhotoFile($_SERVER['QUERY_STRING'])) {
    header('Location: resultat.php?csv='.urlencode($csv));
    exit;
}

header('Location: camera.php?csv='.urlencode($csv));
