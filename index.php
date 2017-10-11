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
        $data = $_POST['text1'];
        $table = 'AUTHORS';
//        var_dump($table);
    }


    if ($_POST['table'] == 'new_book')
    {
        $objMySQL = new MySQL();
        $objMySQL->pdo = $objMyPDO->pdo;
        $objMyPDO = $objMySQL;
        $keyData = "`name`, `title`,`price`,`descript`";
        $key = "`name`";
        $data = $_POST['text1'];
        $table = 'BOOKS';
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
            $objMyPDO->insert($table, $keyData)->values($data)->exec();
            $report = SAVE_OK;
        }

//DELETE
        if ($act == 'delete')
        {
            $objMyPDO->flag = 'delete';
            $del=$objMyPDO->delete()->from($table)->where($key, $data)->exec();
            $report = DELETE_OK;
            var_dump($del);
        }
//UPDATE
        if ($act == 'update')
        {
            $objMyPDO->flag = 'update';
            $objMyPDO->update($table)->set($data, $_POST['text1'])
                    ->where($key, $data)->exec();
            $report = UPDATE_OK;
        }
    }
}

include_once './templates/tmpl_index.php';
