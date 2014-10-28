<?php
Class Api_Abstract {
    
    protected $id = "";
    protected $params = "";
    protected $headerType = "";
    
    public function __construct($params = array(), $headerType = "JSON") {
        $this->id = isset($params['id'])?$params['id']:'';
        $this->params = isset($params['params'])?$params['params']:'';
        $this->headerType = $headerType;
    }

    protected function returnData($data = array()){
        switch ($this->headerType){
            case 'JSON' : 
                //header('Content-type: application/json');
                echo json_encode($data); return;
                
            case 'XML' : 
                $xml = new SimpleXMLElement('<root/>');
                array_walk_recursive($data, array ($xml, 'addChild'));
                print $xml->asXML();
                return;
                
            default :
                //header('Content-type: application/json');
                echo json_encode($data); return;
        }
    }
    
    protected function handleError($message){
        $data['success'] = 0;
        $data['message'] = $message;
        $this->returnData($data);
    }
}