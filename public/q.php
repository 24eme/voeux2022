<?php

require __DIR__.'/config.inc.php'; 

if(!isset($_GET['q']) || !preg_match("/^[a-z0-9]+$/", $_GET['q'])) {
    echo "Paramètre \"q\" non renseigné ou invalide";
    exit(1);
}

if(!file_exists(DB_DIR."/".$_GET['q'].".csv")) {
    echo "Ce code n'existe pas";
    exit(1);
}

$csv = file_get_contents(DB_DIR."/".$_GET['q'].".csv");

header('Location: camera.php?csv='.urlencode($csv));
