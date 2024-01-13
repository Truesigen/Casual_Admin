<?php

namespace App\Resources\Database;

use App\Resources\Entity;

class SqlQueryBuilder
{
    private \PDO $dbc;

    private array $entityFields;

    private string $table;

    private string $query;

    private $fetchedData = [];

    public function __construct($table, $entityFields)
    {
        $this->table = $table;
        $this->entityFields = $entityFields;
        $this->dbc = MysqlConnection::getConnection();
    }

    public function select(string $field, string $value, array $columns = ['*'], int $limit = null): SqlQueryBuilder
    {
        $columns = implode(', ', array_values($columns));
        $field = in_array($field, $this->entityFields) ? $field : null;

        $this->query = "SELECT $columns FROM  $this->table WHERE $field = ?";

        if (isset($limit)) {
            $this->query .= " LIMIT $limit";
        }

        $stmt = $this->fetch([$value]);
        $this->fetchedData = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $this;
    }

    public function selectAll(): SqlQueryBuilder
    {
        $this->query = "SELECT * FROM $this->table";
        $stmt = $this->fetch();
        $this->fetchedData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this;
    }

    public function insert(Entity $entity): SqlQueryBuilder
    {
        $massive = [];

        foreach ($this->entityFields as $value) {
            if (property_exists($entity, $value)) {
                $massive[$value] = $entity->$value;
            }
        }

        $fieldsName = implode(', ', array_keys($massive));
        $placeholders = implode(', ', array_map(fn ($data) => '?', $massive));

        $this->query = "INSERT INTO $this->table ($fieldsName) VALUES ($placeholders)";

        $this->fetch(array_values($massive));

        return $this;
    }

    public function update(): SqlQueryBuilder
    {
        $fieldsName = implode(', ', array_map(fn ($data) => "$data = ?", $this->entityFields));
        $fieldsValue = array_map(fn ($data) => $this->$data, $this->entityFields);

        $sql = "UPDATE $this->tableName SET $fieldsName WHERE id = $fieldsValue[0]";

        $this->fetch($fieldsValue);

        return $this;
    }

    public function delete()
    {
        //TODO DELETE
        $this->query = "DELETE FROM $this->table WHERE";
    }

    public function get(): array|int
    {
        return empty($this->fetchedData) ? $this->dbc->lastInsertId() : $this->fetchedData;
    }

    private function fetch(array $properties = []): \PDOStatement
    {
        $stmt = $this->dbc->prepare($this->query);
        try {
            $stmt->execute($properties);
        } catch(\PDOException $exception) {
            echo $exception->getMessage();
        }

        return $stmt;
    }
}
