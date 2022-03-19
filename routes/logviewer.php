<?php

use Illuminate\Support\Facades\Route;
use Nimaw\Logviewer\Http\Livewire\Index;

Route::get(config('logviewer.route'), Index::class)
    ->name('logviewer.index')->middleware(
        !config('logviewer.middleware') ? ['web'] : array_unique(array_merge(['web'], (array) config('logviewer.middleware')))
    );
