<?php

namespace App\Resourses;

interface EntityInterface
{
    public function updateValues(): void;

    public function first(string $fieldName, string $fieldValie): object|false;

    public function findAll(): array;

    public function insert(array $values): int|bool;

    public function setValues(array $values, $object = null): object;
}
