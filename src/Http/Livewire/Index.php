<?php

namespace Nimaw\Logviewer\Http\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Nimaw\Logviewer\Services\LogviewerService;

class Index extends Component
{
    use WithPagination;
    public $lines, $file, $keyword;
    private $service;
    protected $queryString = [
        'file'
    ];
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->bindService();
    }

    public function render()
    {
        $this->bindService();
        $file = $this->service->getFile($this->file);
        $this->lines = $this->service->getLines($file, $this->keyword);
        $lines = [];
        if (!is_null($this->lines)) {
            foreach ($this->lines as $line) {
                $date = $this->service->getDate($line);
                $content = $this->service->getContent($line);
                $level = $this->service->getLevel($line);
                $lineContent = [
                    'date' => $date,
                    'content' => $this->keyword != null ? preg_replace("/($this->keyword)/i", "<span class='highlight'>{$this->keyword}</span>", $content) : $content,
                    'level' => $level
                ];
                array_push($lines, $lineContent);
            }
        }

        $items = $this->paginate(collect($lines)->sortByDesc('date'), config('logviewer.per_page', 15));
        return view('logviewer::livewire.logviewer.index', [
            'items' => $items
        ])->extends('logviewer::layouts.app')
            ->section('content');
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function bindService()
    {
        if (is_null($this->service)) {
            $this->service = new LogviewerService();
        }
    }
}
