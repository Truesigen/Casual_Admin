<?php

namespace App\Resourses;

abstract class Entity
{
    protected \PDO $dbc;

    protected string $tableName;

    protected array $fields;

    protected function __construct(\PDO $dbc, string $tableName)
    {
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }

    public function insert(array $values): int|bool
    {
        $fields = implode(', ', array_keys($values));

        $fieldValue = '';

        if (count($values) > 0) {
            $fieldValue = implode(', ', array_map(fn ($data) => ":$data", array_keys($values)));
        }

        $sql = "INSERT INTO $this->tableName ($fields) VALUES ($fieldValue)";
        $stmt = $this->dbc->prepare($sql);

        try {
            $stmt->execute($values);
        } catch(\PDOException $exception) {
            return false;
        }

        return $this->dbc->lastInsertId();
    }

    public function first(string $fieldName, string $fieldValue): object|false
    {
        if (empty($fieldValue)) {
            return false;
        }

        $sql = "SELECT * FROM $this->tableName WHERE $fieldName = ? LIMIT 1";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([$fieldValue]);
        $databaseData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($databaseData) {
            $this->setValues($databaseData);

            return $this;
        }

        return false;
    }

    public function updateValues(): void
    {
        $fieldsName = implode(', ', array_map(fn ($data) => "$data = ?", $this->fields));
        $fieldsValue = array_map(fn ($data) => $this->$data, $this->fields);

        $sql = "UPDATE $this->tableName SET $fieldsName WHERE id = $fieldsValue[0]";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($fieldsValue);
    }

    public function findAll(): array
    {
        $result = [];
        $sql = "SELECT * FROM $this->tableName";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $databaseData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($databaseData) {
            $className = static::class;

            foreach ($databaseData as $item) {
                $object = new $className($this->dbc);
                $object = $this->setValues($item, $object);
                $result[] = $object;
            }
        }

        return $result;
    }

    public function setValues(array $values, $object = null): object
    {
        if ($object == null) {
            $object = $this;
        }

        foreach ($object->fields as $item) {
            if (isset($values[$item])) {
                $object->$item = $values[$item];
            }
        }

        return $object;
    }
}
?>
   