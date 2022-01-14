<?php

const SCRIPT_DIR = __DIR__.'/../affiche';
const BIN_DIR = SCRIPT_DIR.'/bin';
const SCRIPT_NAME = 'generate.sh';

$templates = array_filter(scandir(SCRIPT_DIR."/template"), function($v) { return strpos($v, ".svg") !== false; });
$tenues = array_filter(scandir(SCRIPT_DIR."/tenue"), function($v) { return strpos($v, ".png") !== false; });
$fonds = array_filter(scandir(SCRIPT_DIR."/fond"), function($v) { return strpos($v, ".png") !== false || strpos($v, ".jpg") !== false; });
$footers = array_filter(scandir(SCRIPT_DIR."/footer"), function($v) { return strpos($v, ".png") !== false || strpos($v, ".jpg") !== false; });
