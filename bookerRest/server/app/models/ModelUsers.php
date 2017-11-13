<?php

include 'ModelDB.php';

class ModelUsers extends ModelDB
{
    public function getUsers($param)
    {
        // var_dump($param);
         if ($param == 'admin' || $param == 'user')
        {
            unset($param['id_user']);
            $sql = 'SELECT'
                .' id,'
                .' name,'
                .' email,'
                .' role_id,'
                .' pass'
                .' FROM kz_users'
                ;
            if (!empty($param))
            {
                if (is_array($param))
                {
                    $sql .= " WHERE ";
                    foreach ($param as $key => $value)
                    {
                        $sql .= 'u.'.$key.'='.$this->pdo->quote($value).' AND ';
                    }
                    $sql = substr($sql, 0, -5);
                }
                $sql .= ' ORDER BY u.id';
            }
            $data = $this->selectDB($sql);
            return $data;
        }
        else if ($param == 'user')
        {
            unset($param['id_user']);
            $sql = 'SELECT'
                .' u.id,'
                .' r.name as role,'
                .' u.role_id,'
                .' u.login,'
                .' u.email,'
                .' u.username'
                .' FROM kz_users u'
                .' LEFT JOIN kz_roles r'
                .' ON u.role_id=r.id';
            if (!empty($param))
            {
                if (is_array($param))
                {
                    $sql .= " WHERE ";
                    foreach ($param as $key => $value)
                    {
                        $sql .= 'u.'.$key.'='.$this->pdo->quote($value).' AND ';
                    }
                    $sql = substr($sql, 0, -5);
                    $data = $this->selectDB($sql);
                    return $data;
                }
            }
            else
            {
                return ERR_NOT_USER;
            }
        }
        else
        {
            return ERR_NOT_USER;
        }
    }


    public function addUser($param)
    {
        if ($param == 'admin')
            {
                $userName = $this->pdo->quote($param['username']);
                $role_id = $this->pdo->quote($param['role_id']);
                $login = $this->pdo->quote($param['login']);
                $pass = $this->pdo->quote($pass);
                $email = $this->pdo->quote($param['email']);
                $sql = 'INSERT INTO kz_users (id, name, pass, role_id, email)
                 VALUES ('.$role_id.', '.$login.', '.$pass.', '.$userName.', '.$email.')';
                $result = $this->execQuery($sql);
                if ($result === false)
                {
                    return ERR_DB_ANSW;
                }
                return $result;
            }
        return ERR_NOT_USER;
    }

    public function loginUser($param)
    {
//         var_dump($param);
        if (!empty($param['login']) && !empty($param['pass']))
        {
            $pass = $param['pass'];
            $login = $this->pdo->quote($param['login']);
            $id = '';
            $role = '';
            $sql = 'SELECT u.id,'
                .' u.name,'
                .' r.role as role,'
                .' u.pass'
                .' FROM kz_users u'
                .' LEFT JOIN kz_roles r'
                .' ON u.role_id=r.id'
                .' WHERE name='.$login;
//            SELECT u.id, r.role as role, u.name, u.pass FROM kz_users u LEFT JOIN kz_roles r ON u.role_id=r.id WHERE name = 'admin'
            $data = $this->selectDB($sql);
//            var_dump($data);
            if (is_array($data))
            {
                foreach ($data as $value)
                {
                    if ($pass !== $value['pass'])
                    {
                        return ERR_PASS;
                    }
                    else
                    {
                        $id = $this->pdo->quote($value['id']);
                        $userName = $value['name'];
                        $role = $value['role'];
                    }
                }
            }
            else
            {
                return ERR_DB_ANSW;
            }
            $arrRes = ['id'=>$id, 'login'=>$login, 'name'=>$userName, 'role'=>$role];
            return $arrRes;
        }
        else
        {
            return ERR_LOG_PASS;
        }
    }

    public function deleteUser($param)
    {
        if ($param == 'admin')
        {
            if ($this->getRole($param['id']) == 'user')
            {
                $id = $this->pdo->quote($param['id']);
                $sql = 'DELETE FROM events WHERE id_user='.$id.' AND time_start > NOW()';
                $this->execQuery($sql);
                $sql = 'DELETE FROM kz_users WHERE id='.$id;
                $result = $this->execQuery($sql);
                return $result;
            }
            else
            {
                $sql = 'SELECT count(role_id) as sum FROM kz_users WHERE role_id=2';
                $data = $this->selectDB($sql);
                if ($data[0]['sum'] > 1)
                {
                    $id = $this->pdo->quote($param['id']);
                    $sql = 'DELETE FROM kz_users WHERE id='.$id;
                    $result = $this->execQuery($sql);
                    return $result;
                }
                return ERR_DB_ANSW;
            }

        }
        return ERR_DEL;
    }

    private function getRole($id)
    {
        $id = $this->pdo->quote($id);
        $sql = 'SELECT r.name as role FROM kz_users u LEFT JOIN kz_roles r ON u.role_id=r.id WHERE u.id='.$id;
        $data = $this->selectDB($sql);
        if (is_array($data))
        {
            return $data[0]['role'];
        }
        return false;
    }

}
