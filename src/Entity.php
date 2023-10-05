<?php
/**
 * abstract class with 1 abstract method initFields(), objects which are extending must realize Active record pattern.
 */
abstract class Entity
{
    protected $dbc;

    protected $tableName;

    protected $fields;

    protected function __construct($dbc, $tableName)
    {
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }

    public function findBy($fieldName, $fieldValue)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $fieldName =:value";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value' => $fieldValue]);
        $databaseData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($databaseData) {
            $this->setValues($databaseData);
        }

        return $this;
    }

public function saveValues()
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

public function findAll()
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

public function setValues($values, $object = null)
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

    abstract protected function initFields();
}
?>
   