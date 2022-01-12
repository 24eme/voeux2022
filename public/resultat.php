<?php

const SCRIPT_DIR = __DIR__.'/../affiche/';
const OUTPUT_DIR = SCRIPT_DIR.'out/';
const BIN_DIR = SCRIPT_DIR.'bin/';
const SCRIPT_NAME = 'generate.sh';

// Pas de ; dans les parametres à passer
// Faille potentielle

$args = [
    'template' => FILTER_SANITIZE_STRING,
    'texte1' => FILTER_SANITIZE_STRING,
    'texte2' => FILTER_SANITIZE_STRING,
    'texte3' => FILTER_SANITIZE_STRING,
    'fond' => FILTER_SANITIZE_STRING,
    'footer' => FILTER_SANITIZE_STRING,
    'tenue' => FILTER_SANITIZE_STRING,
    'qrcode' => FILTER_SANITIZE_STRING,
    'capture' => FILTER_SANITIZE_STRING
];

$GET = filter_input_array(INPUT_GET, $args);
$output = '/tmp/output';

shell_exec(
    BIN_DIR.SCRIPT_NAME . ' '
    . implode(' ', [
        $output,
        SCRIPT_DIR.$GET['template'],
        $GET['texte1'],
        $GET['texte2'],
        $GET['texte3'],
        SCRIPT_DIR.$GET['fond'],
        SCRIPT_DIR.$GET['footer'],
        SCRIPT_DIR.$GET['tenue'],
        $GET['qrcode']
    ])
);

$fp = fopen($output.'.png', 'rb');

header('Content-type: image/png');
header('Content-size: '.filesize($output.'.png'));

fpassthru($fp);
