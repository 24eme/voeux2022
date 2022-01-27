<?php

require __DIR__.'/config.inc.php';

if(!$title2) {
    $title2 = "Patrick Monzy";
}
if(!$slogan) {
    $slogan = "Parce que je le mérite vraiment";
}

if($csvId && $csv) {
    file_put_contents(DB_DIR."/".$csvId.".csv", $csv);
}

$format = "png";

if(isset($_GET['format']) && $_GET['format'] == "pdf") {
	$format = "pdf";
}

$tete = "https://voeux.24eme.fr/2022/q.php?".$csvId;
if (@$_GET['public']) {
	$tete .= "&public=true";
}

if(isset($_GET['numero']) && $_GET['numero']*1 > 0) {
    $photoFileNumber = $_GET['numero']*1;
} else {
    $photoFileNumber = getLastPhotoFileNumber($csvId);
}

$cameraFile = $csvId.'_'.sprintf("%03d", $photoFileNumber).'.png';

if(file_exists(UPLOAD_DIR.'/'.$cameraFile)) {
    $fileImage = UPLOAD_DIR.'/'.$csvId.'_'.sprintf("%03d", $photoFileNumber).'_affiche_final.'.$format;
    $tete = UPLOAD_DIR.'/'.$cameraFile;
}else{
    $fileImage = UPLOAD_DIR.'/'.$csvId.'_'.sprintf("%03d", $photoFileNumber).'_affiche_qrcode.'.$format;
}

if(!file_exists($fileImage)) {
  shell_exec(
    BIN_DIR.'/'.SCRIPT_NAME . ' '.
        $fileImage.' '.
        'template/'.$template.' '.
        '"'.$title1.'" '.
        '"'.$title2.'" '.
        '"'.$slogan.'" '.
        'fond/'.$fond.' '.
        'footer/'.$footer.' '.
        'tenue/'.$tenue.' '.
        $tete
  );
}

$fp = fopen($fileImage, 'rb');

if($format == 'png') {
	header('Content-type: image/png');
}
if($format == 'pdf') {
	header('Content-type: application/pdf');
    $name = strtolower(date("YmdHis").'_'.$title1.'_'.$title2);
    $name = preg_replace('/[^a-z0-9_]/', '', $name);
    header('Content-Disposition: attachment; filename="'.$name.'.pdf"');
}
header('Content-size: '.filesize($fileImage));

fpassthru($fp);
