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

    public function getUsers($param)
    {
        try
        {
                $result = $this->model->getUsers($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function postUsers($param)
    {
        try
        {
            $result = $this->model->addUser($param);
            return $this->response->serverSuccess(200, $result);

        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function putUsers($param)
    {
        try
        {
            if (isset($param['id_user']))
            {
                $result = $this->model->editUser($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->loginUser($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function deleteUsers($param)
    {
        try
        {
            $result = $this->model->deleteUser($param);
            return $this->response->serverSuccess(200, $result);

        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$users = new Users();
