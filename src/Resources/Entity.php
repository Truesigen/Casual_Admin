<?php

namespace Kernel\Resources;

use AllowDynamicProperties;
use Kernel\Resources\Database\SqlQueryBuilder;

#[AllowDynamicProperties]
abstract class Entity
{
    protected string $table;

    protected array $fields;

    public array $original = [];

    public function __construct() {}

    public function builder(): SqlQueryBuilder
    {
        return new SqlQueryBuilder($this->table, static::class);
    }

    public function save()
    {

        $insert = [];
        foreach ($this->fields as $value) {
            if (property_exists($this, $value)) {
                $insert[$value] = $this->$value;
            }
        }

        return $this->builder()->insert($insert)->execute()->getLastInsertId();
    }

    public function update()
    {
        $update = [];

        foreach ($this->fields as $value) {
            if (property_exists($this, $value) && $this->original[$value] != $this->$value) {
                $update[$value] = $this->$value;

            }
        }

        $this->builder()->update($this->id, $update)->execute();

        return $this->find($this->id);
    }

    public function delete()
    {
        return $this->builder()->delete($this->id)->execute();
    }

    public function fill(array $values): Entity
    {

        foreach ($this->fields as $field) {
            if (array_key_exists($field, $values)) {
                $this->$field = $values[$field];
            }
        }

        return $this;
    }

    public function all(): array
    {
        return $this->builder()->select()->execute()->get();
    }

    public function find($id): Entity
    {
        return $this->builder()->select()->where('id', '=', $id)->execute()->first();
    }

    public function toJson()
    {
        return $this->original;
    }

    public function assemblingEntity(array $dbValues): Entity
    {
        foreach ($dbValues as $key => $value) {
            $this->$key = $value;
            $this->original[$key] = $value;
        }

        return $this;
    }

    protected function hasOne(string $model, string $column, string $localKey)
    {
        if (in_array($localKey, $this->fields)) {
            $newProperty = str_replace('_id', '', $localKey);

            $this->$newProperty = (new $model)->builder()->select()->where($column, '=', $this->$localKey)->execute()->first();
        }

        return $this;
    }
}
?>
   