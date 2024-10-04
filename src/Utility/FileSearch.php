<?php

namespace DubOgp\Utility;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileSearch
{
    //再起的にファイルを検索する
    public static function searchFiles($directory, $pattern)
    {
        $files = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && fnmatch($pattern, $file->getFilename())) {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }
}
