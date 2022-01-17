<?php

require __DIR__.'/config.inc.php';

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
        $fileImage,
        'template/'.$template,
        '"'.$title1.'"',
        '"'.$title2.'"',
        '"'.$slogan.'"',
        'fond/'.$fond,
        'footer/'.$footer,
        'tenue/'.$tenue,
        'http://'
    ])
);

$fp = fopen($fileImage, 'rb');

header('Content-type: image/png');
header('Content-size: '.filesize($fileImage));

fpassthru($fp);

unlink($fileImage);
unlink(str_replace(".png", "", $fileImage));
