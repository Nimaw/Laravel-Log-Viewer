<?php

namespace Nimaw\Logviewer\Services;

use Illuminate\Support\Facades\File;
use Nimaw\Logviewer\Classes\LogLevels;
use Illuminate\Support\Str;

class LogviewerService
{
    public function getLines($file, $keyword = null)
    {
        $lines = collect();
        while (($line = stream_get_line($file, 1024 * 1024, "\n")) !== false) {
            if (Str::startsWith($line, '[') && preg_match('/^.["["0-9]/', $line)) {
                if ($keyword != null) {
                    if (Str::contains($line, $keyword)) {
                        $lines->prepend($line);
                    }
                } else {
                    $lines->prepend($line);
                }
            }
        }
        return $lines;
    }

    public function getDate($str, $from = '[', $to = ']')
    {
        $string = substr($str, strpos($str, $from) + strlen($from));

        if (strstr($string, $to, true) != FALSE) {
            $string = strstr($string, $to, true);
        }

        return $string;
    }

    public function getLevel($line)
    {
        $levels  = LogLevels::all();
        $chatstrArr = explode(' ', Str::lower($line));
        foreach ($chatstrArr as $character) {
            foreach ($levels as $level) {
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
        if ($handle = opendir(config('logviewer.logs_path', storage_path('logs/')))) {
            while (false !== ($entry = readdir($handle))) {
                if (preg_match('/\.log$/', $entry)) {
                    array_push($files, $entry);
                }
            }
            closedir($handle);
        }
        return $files;
    }

    public function getFile($file)
    {
        $file = $file == null ? config('logviewer.default_log') : $file;
        return fopen($this->resolveLogsPath($file), 'r');
    }

    public function resolveLogsPath($file = null)
    {
        $path = config('logviewer.logs_path' . $file, storage_path('logs/' . $file));
        if (!File::exists($path)) {
            return config('logviewer.default_log');
        }
        return $path;
    }

    public function levels()
    {
        return LogLevels::all();
    }
}
