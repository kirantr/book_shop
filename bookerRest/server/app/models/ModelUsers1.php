<?php
class ModelUsers extends ModelDB
{
    public function getUsers($param)
    {
        if ($this->checkData($param) == 'admin')
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
                    foreach ($param as $key => $val)
                    {
                        $sql .= 'u.'.$key.'='.$this->pdo->quote($val).' AND ';
                    }
                    $sql = substr($sql, 0, -5);
                }
                $sql .= ' ORDER BY u.id';
            }
            else
            {
                $sql .= ' ORDER BY u.id';
            }
            $data = $this->selectQuery($sql);
            return $data;
        }
        else if ($this->checkData($param) == 'user')
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
                    foreach ($param as $key => $val)
                    {
                        $sql .= 'u.'.$key.'='.$this->pdo->quote($val).' AND ';
                    }
                    $sql = substr($sql, 0, -5);
                    $data = $this->selectQuery($sql);
                    return $data;
                }
            }
            else
            {
                return ERR;
            }
        }
        else
        {
            return ERR;
        }
    }


    public function addUser($param)
    {
        if ($this->checkData($param) == 'admin')
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
                    return ERR;
                }
                return $result;
            }
            return $validate;
        }
        return ERR_ACCESS;
    }

    public function loginUser($param)
    {
        if (!empty($param['login']) && !empty($param['pass']))
        {
            $pass = $param['pass'];
            $login = $this->pdo->quote($param['login']);
            $id = '';
            $role = '';
            $sql = 'SELECT u.id,'
                .' r.name as role,'
                .' u.username,'
                .' u.pass'
                .' FROM users u'
                .' LEFT JOIN roles r'
                .' ON u.id_role=r.id'
                .' WHERE login='.$login;
            $data = $this->selectQuery($sql);
            if (is_array($data))
            {
                foreach ($data as $val)
                {
                    if ($pass !== $val['pass'])
                    {
                        return ERR;
                    }
                    else
                    {
                        $id = $this->pdo->quote($val['id']);
                        $userName = $val['username'];
                        $role = $val['role'];
                    }
                }
            }
            else
            {
                return ERR;
            }
            $arrRes = ['id'=>$id, 'login'=>$login, 'username'=>$userName, 'role'=>$role];
            return $arrRes;
        }
        else
        {
            return ERR;
        }
    }

    public function deleteUser($param)
    {
        if ($this->checkData($param) == 'admin')
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
                $data = $this->selectQuery($sql);
                if ($data[0]['sum'] > 1)
                {
                    $id = $this->pdo->quote($param['id']);
                    $sql = 'DELETE FROM users WHERE id='.$id;
                    $result = $this->execQuery($sql);
                    return $result;
                }
                return ERR;
            }

        }
        return ERR;
    }

    private function getRole($id)
    {
        $id = $this->pdo->quote($id);
        $sql = 'SELECT r.name as role FROM users u LEFT JOIN roles r ON u.id_role=r.id WHERE u.id='.$id;
        $data = $this->selectQuery($sql);
        if (is_array($data))
        {
            return $data[0]['role'];
        }
        return false;
    }

}
