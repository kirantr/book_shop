<?php
include 'ModelDB.php';

class ModelRooms extends ModelDB
{
   public function getRooms($param)
    {
        var_dump('$param = ', $param);
        if ($param == 'admin' || $param == 'user' )
        {
            unset($param['id_user']);
            $sql = 'SELECT id, name FROM kz_rooms';
            if ($param != false) {
                if (is_array($param)) {
                    $sql .= " WHERE ";
                    foreach ($param as $key => $val) {
                        $sql .= $key . '=' . $this->pdo->quote($val) . ' AND ';
                    }
                    $sql = substr($sql, 0, -5);
                }
                $sql .= ' ORDER BY id';
            } else {
                $sql .= ' ORDER BY id';
            }
            $data = $this->selectQuery($sql);
            return $data;
        }
        else
        {
            return ERR_ACCESS;
        }
    }
}