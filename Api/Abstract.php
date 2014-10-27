<?php
Class Api_Abstract {
    
    protected $id = "";
    protected $params = "";
    
    public function __construct($params = array()) {
        $this->id = isset($params['id'])?$params['id']:'';
        $this->params = isset($params['params'])?$params['params']:'';
    }
    
    protected function returnData($data = array()){
        header('Content-type: application/json');
        echo json_encode($data); return;
    }
    
    protected function handleError($message){
        header('Content-type: application/json');
        $data['success'] = 0;
        $data['message'] = $message;
        echo json_encode($data); return;
    }
}