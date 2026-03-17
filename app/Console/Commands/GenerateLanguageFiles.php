<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateLanguageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:generate {--overwrite : Overwrite existing translations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate language files for all languages based on English structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $langPath = resource_path('lang');
        $sourceLang = 'en';
        $sourcePath = $langPath . '/' . $sourceLang;

        if (!File::exists($sourcePath)) {
            $this->error("Source language '{$sourceLang}' not found!");
            return 1;
        }

        $sourceFiles = File::files($sourcePath);
        $langFolders = File::directories($langPath);
        $overwrite = $this->option('overwrite');

        $this->info("Generating language files based on '{$sourceLang}' structure...");

        foreach ($langFolders as $langFolder) {
            $lang = basename($langFolder);

            if ($lang === $sourceLang) {
                continue; // Skip source language
            }

            $this->info("Processing language: {$lang}");

            foreach ($sourceFiles as $sourceFile) {
                $fileName = $sourceFile->getFilename();
                $targetFile = "{$langFolder}/{$fileName}";

                // Skip system files and DS_Store
                if (in_array($fileName, ['.DS_Store'])) {
                    continue;
                }

                // If file exists and overwrite is not enabled, skip
                if (File::exists($targetFile) && !$overwrite) {
                    $this->info("  - {$fileName} already exists. Skipping.");
                    continue;
                }

                // If file exists, merge with existing translations
                if (File::exists($targetFile) && $overwrite) {
                    $sourceContent = require $sourceFile->getPathname();
                    $targetContent = require $targetFile;

                    // Keep existing translations, add new keys
                    $merged = [];
                    foreach ($sourceContent as $key => $value) {
                        if (isset($targetContent[$key])) {
                            $merged[$key] = $targetContent[$key];
                        } else {
                            $merged[$key] = $value; // Use source value for new keys
                        }
                    }

                    // Generate PHP code
                    $content = "<?php\nreturn " . $this->varExport($merged) . ";\n";
                    File::put($targetFile, $content);
                    $this->info("  - {$fileName} merged with existing translations.");
                } else {
                    // File doesn't exist, copy the structure with English values
                    $sourceContent = require $sourceFile->getPathname();
                    $content = "<?php\nreturn " . $this->varExport($sourceContent) . ";\n";
                    File::put($targetFile, $content);
                    $this->info("  - {$fileName} created with English values.");
                }
            }
        }

        $this->info('Language files generation completed!');
        return 0;
    }

    /**
     * Custom var_export function to get proper array formatting
     */
    private function varExport($expression, $indent = "    ")
    {
        switch (gettype($expression)) {
            case 'array':
                $result = [];
                $result[] = '[';

                foreach ($expression as $key => $value) {
                    $result[] = $indent . '    ' . var_export($key, true) . ' => ' . $this->varExport($value, $indent . '    ') . ',';
                }

                $result[] = $indent . ']';
                return implode("\n", $result);

            default:
                return var_export($expression, true);
        }
    }
}
