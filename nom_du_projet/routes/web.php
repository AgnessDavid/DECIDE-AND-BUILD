<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TemplateController;


 
Route::get('/',[TemplateController::class,'index']);