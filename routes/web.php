<?php

use App\Models\Recruitment\FpsRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fps-request/{fps}/preview', function (FpsRequest $fps) {
    return view('pdf.fps-request', [
        'record' => $fps->load('items.position'),
    ]);
})->name('fps.preview');
