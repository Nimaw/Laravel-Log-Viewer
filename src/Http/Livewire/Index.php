<?php

namespace Nimaw\Logviewer\Http\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Nimaw\Logviewer\Services\LogviewerService;
use Illuminate\Support\Str;

class Index extends Component
{
    public $lines;
    private $service;

    public function mount()
    {
        $this->service = new LogviewerService();
    }

    public function render()
    {
        $lines = collect();
        $file = fopen(storage_path('logs/laravel.log'), 'r');
        while (($line = stream_get_line($file, 1024 * 1024, "\n")) !== false) {
            if (Str::startsWith($line, '[') && preg_match('/^.["["0-9]/', $line)) {
                $lines->prepend($line);
            }
        }
        dd($lines);
        if (!is_null($this->lines)) {
            foreach ($this->lines as $line) {
                $date = $this->service->getDate($line);
                $content = 's';
                $level = $this->service->getLevel($line);
                $lineContent = [
                    'date' => $date,
                    'content' => $content,
                    'level' => $level
                ];
                array_push($lines, $lineContent);
            }
        }
        $items = $this->paginate(collect($lines));
        return view('logviewer::livewire.logviewer.index', [
            'items' => $items
        ])->extends('logviewer::layouts.app');
    }

    function get_string_between($str, $from, $to)
    {

        $string = substr($str, strpos($str, $from) + strlen($from));

        if (strstr($string, $to, TRUE) != FALSE) {

            $string = strstr($string, $to, TRUE);
        }

        return $string;
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
