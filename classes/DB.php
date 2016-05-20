<?php

class DB{
    /**
     * @var PDO
     */
    private $connection;
    /*
    public $dsns;
    public $base_dir;
    */
    /**
     * DB constructor.
     * @param PDO|null $connection
     */
    public function __construct(PDO $connection = null){
        $this->connection = $connection;
        if ($this->connection === null) {
            $base_dir = dirname(__FILE__)."/../config/dsns.ini";
            $dsns = parse_ini_file( $base_dir, true );
            $denom_db = $dsns['DSNS']['denom_db'];
            $this->connection = new PDO(
                $denom_db['dbtype'].':host='.$denom_db['host'].';dbname='.$denom_db['database'],
                $denom_db['username'],
                $denom_db['password']
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