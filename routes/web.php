<?php

use App\Livewire\Homepage;
use App\Livewire\TestComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', TestComponent::class);

Route::get('/', Homepage::class);
Route::get('/{slug}', Homepage::class);
