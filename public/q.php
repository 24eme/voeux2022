<?php

require __DIR__.'/config.inc.php'; 

if(!isset($_SERVER['QUERY_STRING']) || !preg_match("/^[a-z0-9_]+$/", $_SERVER['QUERY_STRING'])) {
    echo "Code non renseigné ou invalide";
    exit(1);
}

$parameters = explode('_', $_SERVER['QUERY_STRING']);
$csvId = $parameters[0];
$numero = null;
if($parameters[1]) {
    $numero = $parameters[1];
}

if(!file_exists(DB_DIR."/".$csvId.".csv")) {
    echo "Ce code n'existe pas";
    exit(1);
}

$csv = file_get_contents(DB_DIR."/".$csvId.".csv");

if($numero !== null) {
    header('Location: resultat.php?csv='.urlencode($csv)."&numero=".$numero);
    exit;
}

if(getLastPhotoFile($csvId)) {
    header('Location: resultat.php?csv='.urlencode($csv).'&numero='.sprintf("%03d", getLastPhotoFileNumber($csvId)));
    exit;
}

header('Location: camera.php?csv='.urlencode($csv));
