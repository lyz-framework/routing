<?php

declare(strict_types=1);

namespace LyzFramework\Routing\Examples\A;

use LyzFramework\Routing\Domain\DeleteMapping;
use LyzFramework\Routing\Domain\GetMapping;
use LyzFramework\Routing\Domain\PatchMapping;
use LyzFramework\Routing\Domain\PostMapping;
use LyzFramework\Routing\Domain\PutMapping;
use LyzFramework\Routing\Domain\RequestMapping;

#[RequestMapping('example')]
class ExempleController
{
    #[GetMapping]
    public function get()
    {
    }

    #[PostMapping]
    public function post()
    {
    }

    #[PutMapping]
    public function put()
    {
    }

    #[DeleteMapping]
    public function delete()
    {
    }

    #[PatchMapping]
    public function patch()
    {
    }
}