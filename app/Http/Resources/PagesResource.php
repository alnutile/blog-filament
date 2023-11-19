<?php

namespace App\Http\Resources;

use App\Domain\Render\IntroDto;
use Facades\App\Domain\Render\RenderContent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var IntroDto $pageIntro */
        $pageIntro = RenderContent::getIntro($this->resource);

        return [
            'id' => $this->id,
            'url' => route('frontend', [
                'slug' => $this->slug,
            ]),
            'title' => str($this->title)->limit(35)->toString(),
            'intro' => $pageIntro->intro,
            'image' => $pageIntro->image,
            'date' => $this->created_at->diffForHumans(),
            'tags' => $this->tags,
        ];
    }
}
