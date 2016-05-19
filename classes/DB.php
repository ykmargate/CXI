<?php

class DB{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * DB constructor.
     * @param PDO|null $connection
     */
    public function __construct(PDO $connection = null){
        $this->connection = $connection;
        if ($this->connection === null) {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=CXI',
                'cxi_user',
                'cxi_pass'
            );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
    }

    /**
     * @param $sql string
     * @param $params array
     * @return array
     */
    public function query($sql, $params=null){
        try {
            $stmt = $this->connection->prepare($sql);
            if(is_null($params)){
                $stmt->execute();
            }
            else{
                $stmt->execute($params);
            }
        }catch(PDOException $e) {
            return $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}