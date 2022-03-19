<?php

namespace Nimaw\Logviewer\Services;

use Nimaw\Logviewer\Classes\LogLevels;
use Illuminate\Support\Str;

class LogviewerService
{
    public function getLines($file)
    {
        $lines = collect();
        while (($line = stream_get_line($file, 1024 * 1024, "\n")) !== false) {
            if (Str::startsWith($line, '[') && preg_match('/^.["["0-9]/', $line)) {
                $lines->prepend($line);
            }
        }
        return $lines;
    }

    public function getDate($str, $from = '[', $to = ']')
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
        $chatstrArr = explode(' ', Str::lower($line));
        foreach ($chatstrArr as $k => $character) {
            foreach ($levels as $kb => $level) {
                if (preg_match("/\.{$level}/", $character)) {
                    return $level;
                }
            }
        }
        return "undefined";
    }

    public function getContent($line)
    {
        return Str::after(Str::lower($line), "{$this->getLevel($line)}:");
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
