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
        if (($this->reqMethod == 'GET') || ($this->reqMethod == 'DELETE'))
        {
            $clearUrl = explode('/api/', $this->url);
//            var_dump($clearUrl);
            $clearUrl = explode('/', $clearUrl[count($clearUrl) - 1], 2);
            $data = $clearUrl[count($clearUrl) - 1];
            preg_match('#(\.[a-z]+)#', $data, $matches);
            if (!empty($matches[0]))
            {
                $this->encode = $matches[0];
                $data = trim($data, $this->encode);
            }
            $data = explode('/', $data);

            $this->data = $data;
//            var_dump( $this->data);
            return $this->data;
        }
        elseif ($this->reqMethod == 'POST')
        {
            $this->data = $_POST;
            return $this->data;
        }
        elseif ($this->reqMethod == 'PUT')
        {
//            var_dump(file_get_contents("php://input"), true);
            $this->data = json_decode(file_get_contents("php://input"), true);
//            var_dump('$this->data= ', $this->data);
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
            case '.xhtml':
                header('Content-Type: text/html; charset=utf-8');
                $str = '<head></head><body><pre>';
                $str .= print_r($data, true);
                $str .= '</pre></body>';
                return $str;
                break;
            case '.xml':
                header("Content-type: text/xml");
                $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
                $this->toXml($data, $xml);
                return $xml->asXML();
                break;
        }
    }

}
