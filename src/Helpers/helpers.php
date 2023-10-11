<?php

declare(strict_types=1);

function extractNamespace(string $filePath): ?string
{
    $namespace = null;

    if (! file_exists($filePath)) return null;

    $tokens = token_get_all(file_get_contents($filePath));

    $count = count($tokens);
    for ($i = 0; $i < $count; $i++) {
        if ($tokens[$i][0] === T_NAMESPACE) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($tokens[$j] === ';') {
                    break;
                }
                if (is_array($tokens[$j])) {
                    $namespace .= $tokens[$j][1];
                } else {
                    $namespace .= $tokens[$j];
                }
            }
            break;
        }
    }

    if (is_null($namespace)) return null;

    $filename = basename($filePath, '.php');
    return '\\' . trim($namespace) . '\\' . $filename;
}