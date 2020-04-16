<?php 

namespace Settings;

class Database 
{ 
    private $db;
    private $host;
    private $username;
    private $password;
    private $connection;

    private static $instance = null;

    public function __construct($host, $db, $username, $password) 
    { 
        $this->db       = $db;
        $this->host     = $host;
        $this->username = $username;
        $this->password = $password;

        try {
                $conn = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->connection = $conn;
            }
        catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
                dd($e);
            }
    } 

    public function execute(string $sql) : int
    {  
        return $this->connection->exec($sql);
    } 

    public function get(string $sql) : array
    {  
        $query = $this->connection->query($sql);
        $numberOfRows = $query->rowCount();

        $result = ($numberOfRows > 1) ? $query->fetchAll(\PDO::FETCH_ASSOC) : $query->fetch(\PDO::FETCH_ASSOC); 

        if(is_bool($result) AND $result === false)
        {
            return [];
        } 

        return $result;
    }

    public function getMulti($sql) : array
    {
        $query = $this->connection->query($sql);

        $result = $query->fetchAll(\PDO::FETCH_ASSOC); 

        if(is_bool($result) AND $result === false)
        {
            return [];
        } 

        return $result;
    }
    
    public function __destruct()
    {
        $this->connection = null;
    }

} 