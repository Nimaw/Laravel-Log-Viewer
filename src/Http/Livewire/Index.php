<?php

namespace Nimaw\Logviewer\Http\Livewire;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('logviewer::livewire.logviewer.index')
            ->extends('logviewer::layouts.app');
    }
}
