<?php

include '../../app/lib/config.php';

class ModelDB
{

    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(DBDNS, DBUSER, DBPASS);
        if (!$this->pdo)
        {
            throw new Exception(ERR_DB);
        }
    }

    protected function selectDB($sql)
    {
//        $sql = $this->pdo->prepare($sql);
//        $result = $sql->execute();
//        if (false == $result)
//        {
//            throw new Exception(ERR_QUERY);
//        }
        $result = $this->pdo->query($sql, PDO::FETCH_ASSOC);
        if (!is_bool($result))
        {
//                var_dump('<br> $result= ', $result);
            $stack = array();
            foreach ($result as $row)
            {
                array_push($stack, $row);
            }
            return $stack;
        }
    }

    protected function insertDB($sql)
    {
        $count = $this->pdo->exec($sql);
        return $count;
    }

}
