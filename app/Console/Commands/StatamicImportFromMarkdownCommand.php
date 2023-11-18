<?php

namespace App\Console\Commands;

use Facades\App\Domain\Importers\StatamicMarkdownImporter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StatamicImportFromMarkdownCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:statamic-import-from-markdown';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Statamic Import from a folder with markdown';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Getting Files");
        $this->withProgressBar(File::allFiles(storage_path('statamic')), function($file) {
            StatamicMarkdownImporter::handle([$file->getContents()]);
        });
    }
}
