<?php

const SCRIPT_DIR = __DIR__.'/../affiche/';
const OUTPUT_DIR = SCRIPT_DIR.'out/';
const BIN_DIR = SCRIPT_DIR.'bin/';
const SCRIPT_NAME = 'generate.sh';

$args = [
    'qrcode' => FILTER_SANITIZE_STRING
];
$GET = filter_input_array(INPUT_GET, $args);
$qrcode = $GET['qrcode'] ?? null;

if(!$qrcode) {
    echo "Aucun qrcode n'a été renseigné";
    exit(1);
}

$output = '/tmp/affiche_'.$qrcode;

$csv = array_map(function ($l) {
    return str_getcsv($l, ';');
}, file(SCRIPT_DIR.'db/exemple.csv'));

$key = array_search($qrcode, array_column($csv, 0));

if ($key === false) {
    echo "Aucun qrcode ne correspond";
    exit(1);
}

$infos = $csv[$key];

shell_exec(
    BIN_DIR.SCRIPT_NAME . ' '
    . implode(' ', [
        $output,
        SCRIPT_DIR.$infos[1],
        $infos[2],
        $infos[3],
        $infos[4],
        SCRIPT_DIR.$infos[5],
        SCRIPT_DIR.$infos[6],
        SCRIPT_DIR.$infos[7]
    ])
);

$fp = fopen($output.'.png', 'rb');

header('Content-type: image/png');
header('Content-size: '.filesize($output.'.png'));

fpassthru($fp);
