<?php

require __DIR__.'/config.inc.php';


$args = [
    'qrcode' => FILTER_SANITIZE_STRING
];
$GET = filter_input_array(INPUT_GET, $args);

$csv = str_getcsv($GET['csv'], ';');

$template = $templates[array_rand($templates)];
$tenue = $tenues[array_rand($tenues)];
$fond = $fonds[array_rand($fonds)];
$footer = $footers[array_rand($footers)];
$title1 = "2022 avec";
$title2 = "Patrick Monzy";
$slogan = "Parce que je le mérite vraiment";

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
