<?php

namespace App\Resources;

use App\Models\EntityFactory;
use App\Resources\Database\SqlQueryBuilder;

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

    public function save()
    {
        return $this->builder()->insert(clone $this)->get();
    }

    public function update()
    {
        return $this->builder()->update()->get();
    }

    public function find(string $fieldName, string $fieldValue): Entity
    {
        $databaseData = $this->builder()->select($fieldName, $fieldValue, ['*'], 1)->get();

        return isset($databaseData) ? $this->fill($databaseData) : false;
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

    public function relations()
    {
        if (method_exists($this, 'hasOne')) {
            [$model, $column] = $this->hasOne();

            foreach ($this->fields as $key => $value) {
                if (str_contains($value, '_id')) {
                    $newValue = str_replace('_id', '', $value);

                    $this->$newValue = EntityFactory::make($model)->first($column, $this->$value);
                }
            }
        }
    }

    abstract protected function initFields(): void;
}
?>
   