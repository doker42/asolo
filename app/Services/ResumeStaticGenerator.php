<?php

namespace App\Services;

use RuntimeException;

readonly class ResumeStaticGenerator
{

    public function generate(string $html): void
    {
        $path = public_path('static/resume.html');
        $tempPath = $path . '.tmp';

        $directory = dirname($path);

        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                throw new RuntimeException(
                    "Unable to create directory: {$directory}"
                );
            }
        }

        // Сначала полностью записываем новый файл.
        if (file_put_contents($tempPath, $html, LOCK_EX) === false) {
            throw new RuntimeException(
                "Unable to write temporary resume file: {$tempPath}"
            );
        }

        // Затем атомарно заменяем старый файл.
        if (!rename($tempPath, $path)) {
            @unlink($tempPath);

            throw new RuntimeException(
                "Unable to replace static resume file: {$path}"
            );
        }
    }
}
