<?php

namespace App\Domain\Importers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Arr;
use IteratorIterator;

class StatamicMarkdownImporter extends StatamicImporter
{

    protected string $content;
    protected ContentDto $contentDto;

    public function handle(IteratorIterator|array $data): void
    {
        $user = User::firstOrFail();
        foreach ($data as $item) {
            $this->contentDto = ContentDto::from([]);
            $exploded = explode("---", $item);
            $content = collect($exploded)->filter(function($item) {
                return !empty($item);
            })->values();
            $this->content = data_get($content, 1, "");
            $header = Arr::first($content);
            $this->getContentDto($header);
            $this->getTagsFromHeader($header);
            $this->makeBlocksFromContent();
            if (! empty($this->contentDto->title) && !empty($this->contentDto->slug)) {
                $page = Page::updateOrCreate([
                    'external_id' => $this->contentDto->externalId,
                ], [
                    'title' => $this->contentDto->title,
                    'author_id' => $user?->id,
                    'created_at' => $this->contentDto->date,
                    'slug' => $this->contentDto->slug,
                    'published' => true,
                    'updated_at' => $this->contentDto->date,
                    'blocks' => $this->contentDto->blocks,
                ]);

                $page->syncTags($this->contentDto->tags);
            }

        }
    }

    protected function getTagsFromHeader(string $content) : void {
        $allTags = collect(explode("\n", $content))
            ->filter(function($item) {
                return !empty($item);
            })
            ->transform(function($item) {
                $exploded = explode(":", $item);
                $key = Arr::first($exploded);
                $value = Arr::last($exploded);
                return [
                    'key' => $key,
                    'value' => $value
                ];
            })->filter(function($item) {

                return str($item['value'])
                    ->trim()
                    ->startsWith("-");
            })->transform(function($item) {
                return str($item['value'])->after("-")->trim()->toString();
            })
            ->values()
            ->filter(function($item) {
                return !empty($item);
            })
            ->toArray();
        $this->contentDto->tags = $allTags;
    }

    protected function getContentDto(string $content) : void {
        collect(explode("\n", $content))
            ->filter(function($item) {
                return !empty($item);
            })
            ->transform(function($item) {
                $exploded = explode(":", $item);
                $key = Arr::first($exploded);
                $value = Arr::last($exploded);
                return [
                    'key' => $key,
                    'value' => $value
                ];
            })->filter(function($item) {
                return in_array($item['key'], [
                    'id',
                    'title',
                    'updated_at',
                    'hero_image'
                ]);
            })->map(function ($item) {
                if($item['key'] === 'id') {
                    $this->contentDto->externalId = trim($item['value']);
                } elseif ($item['key'] === 'title') {
                    $this->contentDto->setTitle($item['value']);
                    $this->contentDto->setSlug($item['value']);
                } elseif ($item['key'] === 'updated_at') {
                    $this->contentDto->date = trim($item['value']);
                } elseif ($item['key'] === 'hero_image') {
                    $this->contentDto->image = trim($item['value']);
                }
                return $item;
            });
    }

    protected function makeBlocksFromContent() : void {
        $blocks[] = [
            'type' => 'intro',
            'data' => [
                'blocks' => str($this->content)->squish()->limit(125),
                'url' => $this->contentDto->image,
            ],
        ];

        $blocks[] = [
            'type' => 'image',
            'data' => [
                'url' => $this->contentDto->image,
                'alt' => $this->contentDto->title,
                'center' => true,
            ],
        ];

        $blocks[] = [
            'type' => 'mark_down_paragraph',
            'data' => [
                'blocks' => $this->content,
            ],
        ];

        $this->contentDto->blocks = $blocks;

    }
}
