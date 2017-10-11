<?php

class MyPDO extends Sql
{

    public $pdo;

    public function __construct()
    {
        try
        {
//            if ('mysql' == $db)
//            {
                $this->pdo = new PDO(DBDNS, DBUSER, DBPASS);
//            }
        }
        catch (PDOException $e)
        {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}
