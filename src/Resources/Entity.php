<?php

namespace Kernel\Resources;

use Kernel\Resources\Database\SqlQueryBuilder;
use Kernel\Resources\Factories\EntityFactory;

abstract class Entity
{
    protected string $tableName;

    protected array $fields;

    protected function __construct(string $tableName)
    {
        $this->initFields();
        $this->tableName = $tableName;
    }

    private function builder(): SqlQueryBuilder
    {
        return new SqlQueryBuilder($this->tableName, $this->fields);
    }

    public function save(): int
    {
        return $this->builder()->insert(clone $this)->get();
    }

    public function update()
    {
        return $this->builder()->update()->get();
    }

    public function find(string $fieldName, string $fieldValue): Entity
    {
        $databaseData = $this->builder()->select($fieldName, $fieldValue, limit: 1)->get();
        if (isset($databaseData) && $databaseData != 0) {
            $this->fill($databaseData);
            $this->relations();
        }

        return $this;
    }

    public function all(): array
    {
        $databaseData = $this->builder()->selectAll()->get();

        $models = array_map(function ($data) {
            $className = static::class;
            $class = new $className();
            $class->fill($data);

            return $class;
        }, $databaseData);

        return $models;
    }

    public function fill(array $values): Entity
    {
        foreach ($this->fields as $item) {
            if (isset($values[$item])) {
                $this->$item = $values[$item];
            }
        }

        return $this;
    }

    public function relations(): void
    {
        if (method_exists($this, 'hasOne')) {
            [$model, $column] = $this->hasOne();

            foreach ($this->fields as $value) {
                if (str_contains($value, '_id')) {
                    $newProperty = str_replace('_id', '', $value);
                    $this->$newProperty = EntityFactory::make($model)->find($column, $this->$value);
                }
            }
        }
    }

    abstract protected function initFields(): void;
}
?>
   