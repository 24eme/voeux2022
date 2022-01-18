<?php

const SCRIPT_DIR = __DIR__.'/../affiche';
const BIN_DIR = SCRIPT_DIR.'/bin';
const SCRIPT_NAME = 'generate.sh';
const UPLOAD_DIR = SCRIPT_DIR.'/camera';
const DB_DIR = SCRIPT_DIR.'/db';

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

$csv = null;

$title1 = "2022 avec";
$title2 = "";
$slogan = "";
$template = $templates[array_rand($templates)];
$tenue = $tenues[array_rand($tenues)];
$fond = $fonds[array_rand($fonds)];
$footer = $footers[array_rand($footers)];

$args = [
    'csv' => FILTER_SANITIZE_ADD_SLASHES
];
$GET = filter_input_array(INPUT_GET, $args);

$csv = $title1.";".$title2.";".$slogan.";".$template.";".$fond.";".$tenue.";".$footer;

if(isset($GET['csv'])) {
    $csv = $GET['csv'];
    $csv = str_replace(array('{', '}', '&', '|', '$', '#'), ' ', $csv);

    $csvData = str_getcsv($csv, ';');

    if(isset($csvData[0]) && $csvData[0]) {
        $title1 = $csvData[0];
    }
    if(isset($csvData[1]) && $csvData[1]) {
        $title2 = $csvData[1];
    }
    if(isset($csvData[2]) && $csvData[2]) {
        $slogan = $csvData[2];
    }
    if(isset($csvData[3]) && $csvData[3]) {
        $template = $csvData[3];
    }
    if(isset($csvData[4]) && $csvData[4]) {
        $fond = $csvData[4];
    }
    if(isset($csvData[5]) && $csvData[5]) {
        $tenue = $csvData[5];
    }
    if(isset($csvData[6]) && $csvData[6]) {
        $footer = $csvData[6];
    }
}

$csvId = substr(hash('sha512', $csv), 0, 7);
