<?php

namespace App\Resourses;

abstract class Entity implements EntityInterface
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

    public function first(string $fieldName, string $fieldValue): object|false
    {
        if (empty($fieldValue)) {
            return false;
        }

        $sql = "SELECT * FROM $this->tableName WHERE $fieldName = ? LIMIT 1";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([$fieldValue]);

        try {
            $databaseData = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $exception) {
            return false;
        }

        $this->setValues($databaseData);

        return $this;
    }

public function saveValues(): void
{
    $fields = [];
    $fieldsValue = [];

    foreach ($this->fields as $item) {
        $fields[] = $item.' = ?';
    }

    foreach ($this->fields as $value) {
        $fieldsValue[] = $this->$value;
    }

    $fieldsName = implode(', ', $fields);

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
    $databaseData = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

private function setValues($values, $object = null)
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

    abstract protected function initFields(): void;
}
?>
   