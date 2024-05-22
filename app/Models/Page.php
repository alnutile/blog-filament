<?php

namespace App\Models;

use App\Domain\Render\IntroDto;
use App\Events\PageUpdatedEvent;
use Carbon\Carbon;
use Facades\App\Domain\Render\RenderContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;

/**
 * @property string $title
 * @property string $slug
 * @property string $external_id
 * @property bool $published
 * @property array $blocks
 * @property Carbon $deleted_at
 * @property User $author
 * @property int $author_id
 * @property int $id
 */
class Page extends Model implements Feedable
{
    use HasFactory;
    use HasTags;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'updated' => PageUpdatedEvent::class,
    ];

    protected $casts = [
        'blocks' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->published;
    }

    public function toSearchableArray(): array
    {
        $content = RenderContent::handle($this);

        $tags = $this->tags->pluck('name')->implode(',');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'blocks' => $content.$tags,
        ];
    }

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with('tags');
    }

    public function toFeedItem(): FeedItem
    {
        /** @var IntroDto $pageIntro */
        $pageIntro = RenderContent::getIntro($this);
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary(str($pageIntro->intro)->stripTags())
            ->image($pageIntro->image)
            ->updated($this->updated_at)
            ->link(route(
                'frontend', [
                    'slug' => $this->slug,
                ]
            ))
            ->authorName('Alfred Nutile')
            ->authorEmail('alfrednutile@gmail.com');
    }

    public static function getFeedItems()
    {
        return Page::published()->latest()->get();
    }
}
