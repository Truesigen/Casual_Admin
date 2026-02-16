<?php

namespace Kernel\Resources\Database;

use Kernel\Resources\Exceptions\ModelNotFoundException;

class SqlQueryBuilder
{
    private \PDO $dbc;

    private string $table;

    private mixed $valuesForDb = [];

    private string $query;

    private string $entity;

    private \PDOStatement $stmt;

    public function __construct(string $table, string $entity)
    {
        $this->table = $table;
        $this->entity = $entity;
        $this->dbc = MysqlConnection::getConnection();
    }

    public function select(array $columns = ['*'])
    {
        $columns = implode(',', $columns);

        $this->query = "SELECT {$columns} FROM {$this->table}";

        return $this;
    }

    public function where(string $field, string $operator, string $value): SqlQueryBuilder
    {

        $this->query .= " WHERE $field $operator ?";
        $this->valuesForDb = [$value];

        return $this;
    }

    public function limit(int $limit = 1)
    {
        $this->query .= " LIMIT $limit";

        return $this;
    }

    public function insert(array $insert): SqlQueryBuilder|false
    {
        if (empty($insert)) {
            return false;
        }

        $fieldsName = implode(', ', array_keys($insert));
        $placeholders = implode(', ', array_map(fn ($data) => '?', $insert));
        $this->query = "INSERT INTO $this->table ({$fieldsName}) VALUES ({$placeholders})";
        $this->valuesForDb = array_values($insert);

        return $this;

    }

    public function update($id, array $update): SqlQueryBuilder|false
    {
        if (empty($update)) {
            return false;
        }

        $fieldsName = implode(', ', array_map(fn ($data) => "$data = ?", array_keys($update)));
        $this->query = "UPDATE {$this->table} SET {$fieldsName}  WHERE id = $id";
        $this->valuesForDb = array_values($update);

        return $this;

    }

    public function getLastInsertId(): string|false
    {
        return $this->dbc->lastInsertId();
    }

    public function delete($id)
    {
        $this->query = "DELETE FROM $this->table WHERE id = $id";

        return $this;
    }

    public function execute()
    {
        $stmt = $this->dbc->prepare($this->query);

        try {
            $stmt->execute($this->valuesForDb);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        if (str_starts_with($stmt->queryString, 'SELECT') && $stmt->rowCount() == 0) {
            throw new ModelNotFoundException(basename(str_replace('\\', '/', $this->entity)).' not found ');
        }

        $this->stmt = $stmt;

        return $this;
    }

    public function get(): array
    {
        $fetchedData = [];
        while ($row = $this->stmt->fetch()) {
            $model = new $this->entity;
            $model->assemblingEntity($row);
            $fetchedData[] = $model;
        }

        return $fetchedData;
    }

    public function first()
    {
        $model = new $this->entity;
        $model->assemblingEntity($this->stmt->fetch());

        return $model;
    }
}
