<?php

declare(strict_types=1);

namespace LyzFramework\Routing\Helpers;

use DirectoryIterator;
use LyzFramework\Routing\Exception\DirectoryDoesNotExistException;

class ReaderFilesPHPDirectory
{
    protected array $files = [];

    public const PHP_EXTENSION = "php";

    /**
     * @throws DirectoryDoesNotExistException
     */
    public function __construct(protected string $directory)
    {
        if (! file_exists($directory)) {
            throw new DirectoryDoesNotExistException("directory $directory does not exist");
        }

        $this->loadFiles(new DirectoryIterator($this->directory));
    }

    protected function loadFiles(DirectoryIterator $directoryIterator): void
    {
        foreach ($directoryIterator as $fileinfo) {
            if ($fileinfo->getBasename() === '.' || $fileinfo->getBasename() === '..') continue;

            if ($fileinfo->isDir()) {
                $this->loadFiles(new DirectoryIterator($fileinfo->getRealPath()));
            }

            if ($fileinfo->getExtension() != self::PHP_EXTENSION) continue;
            $this->files[] = $fileinfo->getPathname();
        }
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}
