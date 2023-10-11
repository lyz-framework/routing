<?php

declare(strict_types=1);

namespace LyzFramework\Routing\Domain;

use Attribute;

#[Attribute]
class RequestMapping
{
    protected string $originClassAnnotation;

    protected string $methodOriginClassAnnotation;

    protected string $prefix;

    public function __construct(
        public readonly string         $path = "",
        public readonly ?RequestMethod $method = null,
        public readonly string         $name = "",
    )
    {
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getOriginClassAnnotation(): string
    {
        return $this->originClassAnnotation;
    }

    public function setOriginClassAnnotation(string $originClassAnnotation): void
    {
        $this->originClassAnnotation = $originClassAnnotation;
    }

    public function getMethodOriginClassAnnotation(): string
    {
        return $this->methodOriginClassAnnotation;
    }

    public function setMethodOriginClassAnnotation(string $methodOriginClassAnnotation): void
    {
        $this->methodOriginClassAnnotation = $methodOriginClassAnnotation;
    }

}