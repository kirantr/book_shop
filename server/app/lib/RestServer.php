<?php

class RestServer
{

    protected $reqMethod;
    protected $url;
    protected $class;
    protected $data;
    protected $encode = ".json";

    protected function run()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        switch ($this->reqMethod)
        {
            case 'GET':
                $this->setMethod('get' . ucfirst($this->getClass()), $this->getData());
                break;
            case 'DELETE':
                $this->setMethod('delete' . ucfirst($this->getClass()), $this->getData());
                break;
            case 'POST':
                $this->setMethod('post' . ucfirst($this->getClass()), $this->getData());
                break;
            case 'PUT':
                $this->setMethod('put' . ucfirst($this->getClass()), $this->getData());
                break;
        }
    }

    protected function setMethod($classMethod, $data = false)
    {
        if (method_exists($this, $classMethod))
        {
            echo $this->$classMethod($data);
        }
        else
        {
            header("HTTP/1.0 405 Method Not Allowed");
            echo $this->class . 'ERROR';
        }
    }

    protected function getClass()
    {
        $clearUrl = explode('/api/', $this->url);
        $clearUrl = explode('/', $clearUrl[count($clearUrl) - 1]);
        $this->class = $clearUrl[0];
        return $this->class;
    }

    protected function getData()
    {
        if (($this->reqMethod == 'GET'))
        {
            $data = explode('/api/', $this->url);
            $data['id'] = $data;
            foreach ($data as $key => $val)
            {
            $this->data = array_combine($key, $val);
            }
        return $this->data;
        }
        elseif ($this->reqMethod == 'POST')
        {
            $this->data = $_POST;
            return $this->data;
        }
        elseif ($this->reqMethod == 'PUT')
        {
            $this->data = json_decode(file_get_contents("php://input"), true);
            return $this->data;
        }
    }

    protected function encodedData($data)
    {
        switch ($this->encode)
        {
            case '.json':
                header('Content-Type: application/json');
                return json_encode($data);
                break;
            case '.txt':
                header("Content-type: text/javascript");
                return print_r($data, true);
                break;
        }
    }

}
