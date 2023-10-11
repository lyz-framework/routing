<?php

declare(strict_types=1);

namespace LyzFramework\Routing\Domain;

use Attribute;

#[Attribute]
class PutMapping extends RequestMapping
{

    public function __construct(string $path = "", string $name = "")
    {
        parent::__construct($path, RequestMethod::PUT, $name);
    }

}