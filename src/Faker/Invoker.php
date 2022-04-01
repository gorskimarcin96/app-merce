<?php

namespace App\Faker;

use ReflectionClass;

trait Invoker
{
    public function invokeProperties(object $object, array $properties = []): mixed
    {
        $reflection = new ReflectionClass(get_class($object));

        foreach ($properties as $field => $value) {
            $reflection->getProperty($field)->setValue($object, $value);
        }

        return $reflection;
    }
}