<?php

Class Router {

    
    private $ApiController = "";
    private $ApiMethod = "";
    private $routes = array(
        "User","Song","Playlist"
    );
    
    private $methods = array(
        "GET"       =>  "Get",
        "POST"      =>  "Create",
        "PUT"       =>  "Update",
        "DELETE"    =>  "Delete"
    );
    public function init(){
        
        $request["method"] = $_SERVER['REQUEST_METHOD'];
        $request["request"] = explode("/", $_SERVER['REQUEST_URI']);
        
        $this->CheckMethodRequest($request["method"]);

        $params = $this->prepareParams($request["method"],$request['request']);
        
        $this->ApiController = ucfirst(strtolower($request['request'][1]));
        $this->ApiAction = $this->methods[$request['method']].$this->ApiController;
        
        if(in_array($this->ApiController,$this->routes)){
            $this->LoadClassApi($this->ApiController);
            $className = "Api_".$this->ApiController;
            $ApiClass = new $className($params);  
            
            if(method_exists($ApiClass, $this->ApiAction)){
                call_user_func_array(array($ApiClass,$this->ApiAction), $params);
            }else{
                header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed");
                echo '{"error" : "Wrong Method"}';
                return;
            }
        }else{
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
            echo '{"error" : "Action Not Found"}';
            return;
        }
    }
    
    private function LoadClassApi($className){
        require API_PATH. "/$className.php";
    }
    
    private function CheckMethodRequest($method){
        if(!isset($this->methods[$method])){
            header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed");
            echo '{"error" : "Wrong Method"}';
            exit;
        }
    }
    
    private function prepareParams($method,$request){

        switch ($method) {
            case 'GET' :
                $params['id'] = $request[2];
                $params['params'] = $_GET;
                break;

            case 'POST' :
                $params['params'] = $_POST;
                break;

            case 'PUT' :
                $params['id'] = $request[2];
                
                die(var_dump($_REQUEST,$_SERVER,$_GET,$_FILES));
                    
                $params['params'] = $params;
                break;

            case 'DELETE' :
                $params['id'] = $request[2];
                if(isset($request[3]) && is_numeric($request[3])){
                    $params['params'] = array("chield_id" => $request[3]);
                }
                break;
        }

        return $params;
    }
}