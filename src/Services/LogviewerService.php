<?php

namespace Nimaw\Logviewer\Services;

use Nimaw\Logviewer\Classes\LogLevels;

class LogviewerService
{
    public function getDate($str, $from = '', $to = ']')
    {
        $string = substr($str, strpos($str, $from) + strlen($from));

        if (strstr($string, $to, TRUE) != FALSE) {
            $string = strstr($string, $to, TRUE);
        }

        return $string;
    }

    public function getLevel($line)
    {
        $levels  = LogLevels::all();
        $chatstrArr = explode(' ', $line);
        foreach ($chatstrArr as $k => $character) {
            foreach ($levels as $kb => $level) {
                if (preg_match("/\.{$level}/", $character)) {
                    return $level;
                }
            }
        }
        return "undefined";
    }

    public function getFiles()
    {
        $files = [];
        if ($handle = opendir(config('logviewer.logs_path'))) {
            while (false !== ($entry = readdir($handle))) {
                if (preg_match('/\.log$/', $entry)) {
                    array_push($files, $entry);
                }
            }
            closedir($handle);
        }
        return $files;
    }
}
