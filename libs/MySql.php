<?php

class Mysql extends Sql
{

    public $pdo;

    public function exec()
    {
        $sql = parent::exec();
        if ($this->flag == 'select')
        {
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
        else
        {
            $result = $this->pdo->exec($sql);
        }
    }

}

?>
