<?php

use LyzFramework\Routing\Exception\DirectoryDoesNotExistException;
use LyzFramework\Routing\Helpers\ReaderFilesPHPDirectory;
use LyzFramework\Routing\Helpers\ReaderRoutes;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ReaderRoutesTest extends TestCase
{

    #[DataProvider('directoriesWithRoutes')]
    public function testNumberRoutes(string $directory, int $numberRoutes)
    {
        $readerFilesDirectory = new ReaderFilesPHPDirectory($directory);
        $readerRoutes = new ReaderRoutes($readerFilesDirectory);
        self::assertCount($numberRoutes, $readerRoutes->getRoutes());
    }

    public static function directoriesWithRoutes(): array
    {
        return [
            [__DIR__ . '/../src', 20],
            [__DIR__ . '/../src/Examples', 20],
            [__DIR__ . '/../src/Examples/A', 15],
            [__DIR__ . '/../src/Examples/A/B', 10],
            [__DIR__ . '/../src/Examples/A/B/C', 5],
        ];
    }

    #[DataProvider('directoriesInvalid')]
    public function testDirectoriesInvalid(string $directory)
    {
        self::expectException(DirectoryDoesNotExistException::class);
        new ReaderFilesPHPDirectory($directory);
    }

    public static function directoriesInvalid(): array
    {
        return [
            [__DIR__ . '/1234567890'],
            [__DIR__ . '/../src/A'],
            [__DIR__ . '/../ABC'],
            [__DIR__ . '/A'],
            [__DIR__ . '/../src/Examples/A/B/C/D'],
        ];
    }

}