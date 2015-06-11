<?php

// Get Class FIle Includes
$dir = $_SERVER["DOCUMENT_ROOT"].'/memo/classes/';
if (!is_dir($dir)) {
    die('Invalid Directory Path for '.$_SERVER["DOCUMENT_ROOT"].$dir);
}

foreach (scandir($dir) as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue;
    include $dir . $file;
}

include 'functions.php';

// Create Memos Instance and grab memos
$memos = new Memos();
$memoBank = $memos->getActiveMemos();
$memosForToday = $memos->getActiveMemosForToday($memoBank);
$memosForTomorrow = $memos->getActiveMemosForTomorrow($memoBank);
