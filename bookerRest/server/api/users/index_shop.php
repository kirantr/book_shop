<?php

include '../../app/lib/RestServer.php';
include '../../app/lib/Response.php';
include '../../app/models/ModelUsers.php';

class Users extends RestServer
{

    private $model;
    private $response;

    public function __construct()
    {
        $this->model = new ModelUsers();
        $this->response = new Response();
        $this->run();
    }

    public function getAuthors($param = false)
    {
        $path = "../../app/models/ModelUsers.php";
        if (file_exists($path))
        {
            if ($param !== false)
            {
                $result = $this->model->getUsers($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getUsers();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        else
        {
            die("File not found!");
        }
    }

}

$books = new Users();
