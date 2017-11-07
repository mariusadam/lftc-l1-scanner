#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

$file = $argv[1];

$scanner = new Scanner(file_get_contents($file));

$scanner->scan();

$output = 'Constants Table'.PHP_EOL;
foreach ($scanner->getConstantsTable()->toArray() as $const => $code) {
    $output .= "$const $code".PHP_EOL;
}
$output .= PHP_EOL."Identifiers table".PHP_EOL;
foreach ($scanner->getIdentifiersTable()->toArray() as $id => $code) {
    $output .= "$id $code".PHP_EOL;
}
$output .= PHP_EOL."Internal form".PHP_EOL;
foreach ($scanner->getInternalForm() as $item) {
    $output .= implode(' ', $item).PHP_EOL;
}
$output .= PHP_EOL;

file_put_contents($file.'.out', $output);
file_put_contents($file.'.tokens', implode(PHP_EOL, $scanner->getTokens()));
