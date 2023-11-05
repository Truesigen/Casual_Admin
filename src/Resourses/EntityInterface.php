<?php

namespace App\Resourses;

interface EntityInterface
{
    public function saveValues(): void;

    public function first(string $fieldName, string $fieldValie): object|false;

    public function findAll(): array;
}
