<?php
namespace  Framework;
use PDO;
class  Database
{
    public $conn;
    public function __construct($config)
    {
        $dsn ="mysql:host={$config['host']};port={$config['port']};
        dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'],$options);
        }catch (\PDOException $e) {
            throw new \Exception("数据库联连接失败:{$e->getMessage()}");
        }
    }

    public function query($query,$params=[])
    {
        try {
            $sth = $this->conn->prepare($query);
            foreach ($params as $param => $value) {
                $sth->bindValue(':'.$param, $value);
            }
            $sth->execute();
            return $sth;
        }catch (\PDOException $e){
            throw new \Exception("数据库请求执行失败:{$e->getMessage()}");
        }

    }
}