<?php

include 'ModelDB.php';

class ModelUsers extends ModelDB
{
    public function getUsers($param)
    {
        // var_dump($param);
         if ($param == 'admin' || $param == 'user')
//        if ($param == '')
        {
            unset($param['id_user']);
            $sql = 'SELECT'
                .' id,'
                .' Name,'
                .' Email,'
                .' Role,'
                .' Pass'
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
            // else
            // {
            //     $sql .= ' ORDER BY u.id';
            // }
            $data = $this->selectDB($sql);
            return $data;
        }
        else if ($param == 'user')
        {
            unset($param['id_user']);
            $sql = 'SELECT'
                .' u.id,'
                .' r.name as role,'
                .' u.id_role,'
                .' u.login,'
                .' u.email,'
                .' u.username'
                .' FROM users u'
                .' LEFT JOIN roles r'
                .' ON u.id_role=r.id';
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
                return ERR1;
            }
        }
        else
        {
            return ERR2;
        }
    }


    public function addUser($param)
    {
        if ($param == 'admin')
        {
            $validate = $this->validator->isValidateRegistration($param);
            if ($validate === true)
            {
                $userName = $this->pdo->quote($param['username']);
                $id_role = $this->pdo->quote($param['id_role']);
                $login = $this->pdo->quote($param['login']);
                $pass = md5(md5(trim($param['pass'])));
                $pass = $this->pdo->quote($pass);
                $email = $this->pdo->quote($param['email']);
                $sql = 'INSERT INTO users (id_role, login, pass, username, email) VALUES ('.$id_role.', '.$login.', '.$pass.', '.$userName.', '.$email.')';
                $result = $this->execQuery($sql);
                if ($result === false)
                {
                    return ERR3;
                }
                return $result;
            }
            return $validate;
        }
        return ERR9;
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
                        return ERR4;
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
                return ERR5;
            }
            $arrRes = ['id'=>$id, 'login'=>$login, 'name'=>$userName, 'role'=>$role];
            return $arrRes;
        }
        else
        {
            return ERR6;
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
                $sql = 'DELETE FROM users WHERE id='.$id;
                $result = $this->execQuery($sql);
                return $result;
            }
            else
            {
                $sql = 'SELECT count(id_role) as sum FROM users WHERE id_role=2';
                $data = $this->selectDB($sql);
                if ($data[0]['sum'] > 1)
                {
                    $id = $this->pdo->quote($param['id']);
                    $sql = 'DELETE FROM users WHERE id='.$id;
                    $result = $this->execQuery($sql);
                    return $result;
                }
                return ERR7;
            }

        }
        return ERR8;
    }

    private function getRole($id)
    {
        $id = $this->pdo->quote($id);
        $sql = 'SELECT r.name as role FROM kz_users u LEFT JOIN kz_roles r ON u.id_role=r.id WHERE u.id='.$id;
        $data = $this->selectDB($sql);
        if (is_array($data))
        {
            return $data[0]['role'];
        }
        return false;
    }

}
