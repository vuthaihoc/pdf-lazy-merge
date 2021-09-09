<?php


namespace HocVT\LazyMerge;


class Merger
{
    public static function merge(string $input) : string {
        $min_score = 1;
        $lines = explode("\n", $input);
        $total_lines = count($lines);
        foreach ($lines as $k => &$line){
            if($k == $total_lines - 1){
                break;
            }
            $next_line = $lines[$k+1];
            $end = preg_match("/\s(\p{L}+)\s*$/ui", $line, $matches) ? trim($matches[1]) : trim($line);
            if(!$end){
                continue;
            }
            $start = preg_match("/^\s*(\p{L}+)\s/ui", $line, $matches) ? trim($matches[1]) : trim($next_line);
            if(!$start){
                continue;
            }
            $pharase = $end . " " . $start;
            $score = self::getScore($pharase, $lines, $min_score);
            if($score > 0){
                dump($pharase, $score, "============");
            }
            if($score < $min_score){
                $line .= "\n";
            }
            if($k == 1000){
                break;
            }
        }
        $output = implode(" ", $lines);
        return $output;
    }

    public static function getScore(string $phrase, array $lines, $min_score = 0) : int
    {
        $score = 0;
        foreach ($lines as $line){
            if(strpos($line, $phrase) !== false){
                $score ++;
            }
            if($min_score && $score > $min_score){
                break;
            }
        }
        return $score;
    }
}