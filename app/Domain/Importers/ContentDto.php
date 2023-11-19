<?php

namespace App\Domain\Importers;

use App\Models\Page;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class ContentDto extends Data
{
    public function __construct(
        public string $date = '',
        public string $slug = '',
        public string $image = 'default-hero.jpg',
        public string $title = '',
        public string $externalId = '',
        public array $blocks = [],
        public array $tags = [],
    ) {
    }

    public function setTitle(string $title): void
    {
        $this->title = str($title)->remove("'")->trim()->toString();
    }

    public function setSlug(string $slug): void
    {
        $slug = str($slug)->remove("'")->trim()->slug()->toString();
        while (Page::whereSlug($slug)->exists()) {
            $slug = str($slug)->remove("'")->trim()->slug()
                ->append(Str::random(5))
                ->toString();
        }
        $this->slug = $slug;
    }
}
