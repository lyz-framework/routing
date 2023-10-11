<?php

declare(strict_types=1);

namespace LyzFramework\Routing\Helpers;

use LyzFramework\Routing\Domain\RequestMapping;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class ReaderRoutes
{
    protected array $routes = [];

    /**
     * @throws ReflectionException
     */
    public function __construct(protected ReaderFilesPHPDirectory $readerClassDirectory)
    {
        $this->loadRoutes();
    }

    /**
     * @throws ReflectionException
     */
    private function loadRoutes(): void
    {
        $files = $this->readerClassDirectory->getFiles();

        foreach ($files as $file) {
            $namespace = extractNamespace($file);
            if (is_null($namespace)) continue;
            $this->loadRoutesClass(new ReflectionClass($namespace));
        }
    }

    /**
     * @throws ReflectionException
     */
    private function loadRoutesClass(ReflectionClass $reflectionClass): void
    {
        foreach ($reflectionClass->getAttributes() as $attribute) {
            /** @var $requestMapping RequestMapping */
            $requestMapping = RequestMapping::class === $attribute->getName() ? $attribute->newInstance() : null;

            foreach ($reflectionClass->getMethods() as $method) {
                $reflectionMethod = new ReflectionMethod($method->class, $method->name);
                $this->loadRoutesMethod($reflectionMethod, $requestMapping);
            }
        }
    }

    private function loadRoutesMethod(ReflectionMethod $reflectionMethod, ?RequestMapping $requestMappingClass): void
    {
        foreach ($reflectionMethod->getAttributes() as $attribute) {
            $instance = $attribute->newInstance();
            if (! $instance instanceof RequestMapping) continue;
            $this->addRouteMethod($instance, $reflectionMethod, $requestMappingClass);
        }
    }

    private function addRouteMethod(RequestMapping $instance, ReflectionMethod $reflectionMethod, ?RequestMapping $requestMappingClass): void
    {
        $instance->setOriginClassAnnotation($reflectionMethod->class);
        $instance->setMethodOriginClassAnnotation($reflectionMethod->getName());

        if (! is_null($requestMappingClass)) {
            $instance->setPrefix($requestMappingClass->path);
        }

        $this->routes[] = $instance;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}