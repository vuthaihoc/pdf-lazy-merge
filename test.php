<?php


require __DIR__ . "/vendor/autoload.php";

$files = glob(__DIR__ . "/input/*.txt");

foreach ($files as $file){
    $file_name = basename($file);
    $input = file_get_contents($file);
    $output = \HocVT\LazyMerge\Merger::merge($input);
    file_put_contents(__DIR__ . "/output/" . $file_name, $output);
}
