<?php

include_once './config.php';
include_once 'libs/Sql.php';
include_once 'libs/MySql.php';

if (isset($_POST['table']))
{
    $act = $_POST['flag'];
    $text1 = $_POST['text1'];
    $text2 = $_POST['text2'];
    $text3 = $_POST['text3'];
    $text4 = $_POST['precent'];
//    if ($_POST['db'] == 'author')
//    {
//        $act = 'author';
//    }

    $objMySQL = new MySQL();

//AUTHORS    
    if ($_POST['table'] == 'new_author')
    {
        $keyData = "`name`";
        $key = "`name`";
        $delData = $text1;
        $data = $text1;
        $table = 'AUTHORS';
//        var_dump($table);
    }

//GENRE
    if ($_POST['table'] == 'new_genre')
    {
        $keyData = "`name`";
        $key = "`name`";
        $delData = $text1;
        $data = $text1;
        $table = 'GENRE';
//        var_dump($table);
    }


//BOOKS    
    if ($_POST['table'] == 'insert_book')
    {
        $keyData = "`title`,`price`,`descript`, `discount`";
        $key = "`title`";
        $delData = $text1;
        $data = $text1 . "', '" . $text2 . "', '" . $text3 . "', '" . $text4;
        $table = 'BOOKS';
//        var_dump($table);
    }

//CUSTOMERS
    if ($_POST['table'] == 'new_user')
    {
        $keyData = "`name`,`login`,`pass`, `discount`";
        $key = "`name`";
        $delData = $text1;
        $data = $text1 . "', '" . $text2 . "', '" . $text3 . "', '" . $text4;
        $table = 'CUSTOMERS';
    }
    
//-----------------------------------------------------------------------------

//SELECT
    if ($act == 'select')
    {
        $objMySQL->flag = 'select';
        $selectMySQL = $objMySQL->select($keyData)->
                        from($table)->exec();
        var_dump($selectMySQL);
//                        from($table)->where($key, "user7")->exec();
    }
    if (isset($_POST['flag']))
    {
        $objMySQL->flag($_POST['flag']);

//NEW BOOK
        if ($_POST['table'] == 'new_book')
        {
        $objMySQL->flag = 'select';
        $selectMySQL = $objMySQL->select("a.`name`, g.`name`")->
                        from('AUTHORS as a, GENRE as g')->exec();
        var_dump($selectMySQL);
        }
//INSERT
        elseif ($act == 'insert')
        {
            $objMySQL->flag = 'insert';
            $objMySQL->insert($table, $keyData)->values($data)->exec();
            $report = SAVE_OK;
            var_dump($objMySQL);
            
        }

//DELETE
        if ($act == 'delete')
        {
            $objMySQL->flag = 'delete';
            $objMySQL->delete()->from($table)->where($key, $delData)->exec();
            $report = DELETE_OK;
            var_dump($objMySQL);
        }
//UPDATE
        if ($act == 'update')
        {
            $objMySQL->flag = 'update';
            $objMySQL->update($table)->set($data, $_POST['text1'])
                    ->where($key, $data)->exec();
            $report = UPDATE_OK;
        }
    }
}

include_once './templates/tmpl_index.php';
