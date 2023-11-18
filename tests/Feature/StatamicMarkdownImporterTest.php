<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Facades\App\Domain\Importers\StatamicMarkdownImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class StatamicMarkdownImporterTest extends TestCase
{


    public function test_imports_markdown(): void
    {
        User::factory()->create();
        $file = File::get(storage_path("statamic/3.md"));
        /**
         * Might not be string when I send it?
         */
        $this->assertDatabaseCount("pages", 0);

        StatamicMarkdownImporter::handle([$file]);

        $this->assertDatabaseCount("pages", 1);

        $page = Page::first();
        $this->assertNotNull($page->slug);
    }
}
