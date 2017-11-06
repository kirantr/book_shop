<?php

include 'ModelDB.php';

class ModelAuthors extends ModelDB
{

    public function getAuthors($param = false)
    {
        $sel1 = 'SELECT id, name FROM authors';
        if ($param !== false)
        {
            if (is_array($param))
            {
                $sel2 = " WHERE ";
                foreach ($param as $key => $value)
                {
                    $sel3 = $key . '=' . "'" . $value . "'" . ' AND ';
                }
            }
        }
        $sel = $sel . $sel1 . $sel2 . $sel3;
        $data = $this->selectDB($sel);
        return $data;
    }

}
