<?php

namespace App\Bases;

use Settings\Database;
use App\Models\Clause;

abstract class BaseModel
{

    protected $db;
    protected $clause;

    public function __construct()
    {
        $this->db = new Database(DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $this->clause = new Clause();
    }

    public function getTableName()
    {
        return $this->table;
    }

    private function db() : object
    {
        return $this->db->connection();
    }

    public function all() : array
    {
        return $this->db->get("SELECT * FROM `$this->table`");
    }

    public function custom(string $sql) 
    {
        // return $this->db->get($sql);
        return $this->db->getMulti($sql);
    }

    public function insert(array $data) : int
    {
        if(is_multidimensional_array($data))
        {
            foreach($data as $row)
            {
                $insert = $this->save($row);
            }
        }
        else 
        {
            $insert = $this->save($data);
        }

        return $insert;
    }

    private function save(array $data) : int
    {
        $values = $this->clause->insert($data);
        $sql = "INSERT INTO `$this->table` $values";
        // dd($sql);
        return $this->db->execute($sql);
    }

    public function getDetail(int $id, string $column = 'id')
    {
        return $this->getWhere([$column => $id]);
    }

    public function getWhere(array $conditions) : array
    {
        $whereClause    = $this->clause->where($conditions);
        $sql            = "SELECT * FROM `$this->table` WHERE $whereClause";
        
        return $this->db->get($sql);
    }

    public function updateWhere(array $updateValues, array $conditions) : int
    {
        $setParams = $this->clause->set($updateValues);
        $whereClause = $this->clause->where($conditions);
        $sql = "UPDATE `$this->table` SET $setParams WHERE $whereClause";
        
        return $this->db->execute($sql);
    }

    public function deleteWhere(array $conditions) : int
    {
        $whereClause = $this->clause->where($conditions);
        $sql = "DELETE FROM `$this->table` WHERE $whereClause";
        
        return $this->db->execute($sql);
    }

}