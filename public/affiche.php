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

$fileImage = tempnam(sys_get_temp_dir(), 'voeux2022').'.png';

$tete = "https://voeux.24eme.fr/2022/q.php?".$csvId;
if($csvId && file_exists(SCRIPT_DIR.'/camera/'.$csvId.'.png')) {
    $tete = 'camera/'.$csvId.'.png';
}

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
$fp = fopen($fileImage, 'rb');

header('Content-type: image/png');
header('Content-size: '.filesize($fileImage));

fpassthru($fp);

unlink($fileImage);
unlink(str_replace(".png", "", $fileImage));
