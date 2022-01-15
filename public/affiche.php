<?php

require __DIR__.'/config.inc.php';

if(!$title1) {
    $title1 = "2022 avec";
}
if(!$title2) {
    $title2 = "Patrick Monzy";
}
if(!$slogan) {
    $slogan = "Parce que je le mérite vraiment";
}

$fileImage = tempnam(sys_get_temp_dir(), 'voeux2022').'.png';

shell_exec(
    BIN_DIR.'/'.SCRIPT_NAME . ' '
    . implode(' ', [
        str_replace('.png', '', $fileImage),
        'template/'.$template,
        '"'.$title1.'"',
        '"'.$title2.'"',
        '"'.$slogan.'"',
        'fond/'.$fond,
        'footer/'.$footer,
        'tenue/'.$tenue,
    ])
);

$fp = fopen($fileImage, 'rb');

header('Content-type: image/png');
header('Content-size: '.filesize($fileImage));

fpassthru($fp);
