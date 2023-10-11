<?php

require_once __DIR__ . '/vendor/autoload.php';

use LyzFramework\Routing\Helpers\ReaderFilesPHPDirectory;
use LyzFramework\Routing\Helpers\ReaderRoutes;

$readerFilesPHPDirectory= new ReaderFilesPHPDirectory(__DIR__ . '/src');
$readerRoutes = new ReaderRoutes($readerFilesPHPDirectory);

var_dump($readerRoutes->getRoutes());
