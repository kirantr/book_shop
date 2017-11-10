<?php
include '../../app/lib/RestServer.php';
include '../../app/lib/Response.php';
include '../../app/models/ModelRooms.php';

class Rooms extends RestServer
{
    private $model;
    private $response;

    public function __construct()
    {
        $this->model = new ModelRooms();
        $this->response = new Response();
        $this->run();
    }

    public function getRooms($param)
    {
        
        try
        {
            $result = $this->model->getRooms($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$rooms = new Rooms();
