<?php

include_once './config.php';
include_once 'libs/Sql.php';
include_once 'libs/MyPDO.php';
include_once 'libs/MySql.php';

if (isset($_POST['table']))
{
    $act = $_POST['flag'];
//    if ($_POST['db'] == 'author')
//    {
//        $act = 'author';
//    }

    $objMyPDO = new MyPDO();

    if ($_POST['table'] == 'new_author')
    {
        $objMySQL = new MySQL();
        $objMySQL->pdo = $objMyPDO->pdo;
        $objMyPDO = $objMySQL;
        $keyData = "`name`";
        $key = "`name`";
        $data = "`data`";
        $table = NAME_TABLE;
//        var_dump($table);
    }

//SELECT
    if ($act == 'select')
    {
        $objMyPDO->flag = 'select';
        $selectMyPDO = $objMyPDO->select($keyData)->
                        from($table)->exec();
//                        from($table)->where($key, "user7")->exec();
    }
    if (isset($_POST['flag']))
    {
        $objMyPDO->flag($_POST['flag']);

//INSERT
        if ($act == 'insert')
        {
            $objMyPDO->flag = 'insert';
            $objMyPDO->insert($table, $keyData)->values($_POST['text'])->exec();
            $report = SAVE_OK;
        }

//DELETE
        if ($act == 'delete')
        {
            $objMyPDO->flag = 'delete';
            $objMyPDO->delete()->from($table)->where('user7', $key)->exec();
            $report = DELETE_OK;
        }
//UPDATE
        if ($act == 'update')
        {
            $objMyPDO->flag = 'update';
            $objMyPDO->update($table)->set($data, $_POST['text'])
                    ->where('user7', $key)->exec();
            $report = UPDATE_OK;
        }
    }
}

include_once './templates/tmpl_index.php';
