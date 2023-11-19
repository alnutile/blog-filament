<?php

use Facades\App\Screens\Welcome\GithubContributions;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/github_contribs', function () {
    $contributions = GithubContributions::handle();

    return response(['github_results' => $contributions]);
})->name('api.contribs');
