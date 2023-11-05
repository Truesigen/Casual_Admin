<?php

namespace App\Models;

use App\Resourses\Entity;

class User extends Entity
{
    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'users');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'username',
            'password',
        ];
    }

    public function checkUser($username, $email)
    {
        $sql = "SELECT $username FROM $this->tableName where $username =:value";
        $data = $this->dbc->prepare($sql);
        $data->execute(['value' => $email]);
        $stmt = $data->fetch(PDO::FETCH_ASSOC);

        return $stmt;
    }

    public function createNewUser($values)
    {
        $fields = implode(', ', $this->fields);
        //$values = implode(', ', $values);

        $sql = "INSERT INTO $this->tableName ($fields) VALUES (?, ?, ?, ?, ?)";
        $data = $this->dbc->prepare($sql);
        $marker = $data->execute($values);
        if ($marker) {
            return true;
        }

        return false;
    }

    public function getTeam()
    {
        //$values = array_flip($values);
        $sql = "SELECT id, name, username FROM $this->tableName";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
