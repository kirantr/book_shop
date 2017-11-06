<?php

include '../../app/lib/RestServer.php';
include '../../app/lib/Response.php';
include '../../app/models/ModelAuthors.php';

class Authors extends RestServer
{

    private $model;
    private $response;

    public function __construct()
    {
        $this->model = new ModelAuthors();
        $this->response = new Response();
        $this->run();
    }

    public function getAuthors($param = false)
    {
        $path = "../../app/models/ModelAuthors.php";
        if (file_exists($path))
        {
            if ($param !== false)
            {
                $result = $this->model->getAuthors($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getAuthors();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        else
        {
            die("File not found!");
        }
    }

}

$books = new Authors();
