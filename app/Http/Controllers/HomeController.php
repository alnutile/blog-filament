<?php

namespace App\Http\Controllers;

use App\Http\Resources\PagesResource;
use App\Models\Page;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home/Show', [
            'posts' => PagesResource::collection(Page::latest()->published()->limit(3)->get()),
        ]);
    }
}
