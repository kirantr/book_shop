<?php
include 'ModelDB.php';

class ModelRooms extends ModelDB
{
   public function getRooms($param)
    {
//        var_dump('$param = ', $param);
        if ($param[2] == '2')
        {
            $sql = 'SELECT id, name FROM kz_rooms';
            $data = $this->selectDB($sql);
//            var_dump($data);
            return $data;
        }
        else
        {
            return ERR_ACCESS;
        }
    }
}