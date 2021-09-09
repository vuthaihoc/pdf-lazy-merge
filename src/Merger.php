<?php


namespace HocVT\LazyMerge;


class Merger
{
    public static function merge(string $input) : string {
        $lines = explode("\n", $input);

        $output = implode(" ", $lines);
        return $output;
    }
}