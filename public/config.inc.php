<?php

const SCRIPT_DIR = __DIR__.'/../affiche';
const BIN_DIR = SCRIPT_DIR.'/bin';
const SCRIPT_NAME = 'generate.sh';

function filter_image($v) {
    if(strpos($v, 'template') !== false) { 
        
        return false;
    } 
    
    return strpos($v, ".svg") !== false || strpos($v, ".png") !== false || strpos($v, ".jpg") !== false; 
}

$templates = array_filter(scandir(SCRIPT_DIR."/template"), function($v) { return filter_image($v); });
$tenues = array_filter(scandir(SCRIPT_DIR."/tenue"), function($v) { return filter_image($v); });
$fonds = array_filter(scandir(SCRIPT_DIR."/fond"), function($v) { return filter_image($v); });
$footers = array_filter(scandir(SCRIPT_DIR."/footer"), function($v) { return filter_image($v); });

$title1 = "";
$title2 = "";
$slogan = "";
$template = $templates[array_rand($templates)];
$tenue = $tenues[array_rand($tenues)];
$fond = $fonds[array_rand($fonds)];
$footer = $footers[array_rand($footers)];

$args = [
    'csv' => FILTER_SANITIZE_STRING
];
$GET = filter_input_array(INPUT_GET, $args);

if(isset($GET['csv'])) {
    $csv = str_getcsv($GET['csv'], ';');

    if(isset($csv[0]) && $csv[0]) {
        $title1 = $csv[0];
    }
    if(isset($csv[1]) && $csv[1]) {
        $title2 = $csv[1];
    }
    if(isset($csv[2]) && $csv[2]) {
        $slogan = $csv[2];
    }
    if(isset($csv[3]) && $csv[3]) {
        $template = $csv[3];
    }
    if(isset($csv[4]) && $csv[4]) {
        $fond = $csv[4];
    }
    if(isset($csv[5]) && $csv[5]) {
        $tenue = $csv[5];
    }
    if(isset($csv[6]) && $csv[6]) {
        $footer = $csv[6];
    }
}
