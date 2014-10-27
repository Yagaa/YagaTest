<?php

Class Router {

    
    private $ApiAction = "";
    private $ApiMethod = "";
    public function init($request){
        require API_PATH. "/User.php";
        $obj = new Api_User();
        $res = call_user_method("GetUser", $obj, array("id" => 1));
        
        $router = new Router();
        
        
        $router->get('/song', array('controller' => 'Song', 'action' => 'playlists'));
        
        $router->get('/song/:id', array('controller' => 'Song', 'action' => 'playlist'));
        $router->delete('/song/:id', $song->deletePlaylist('@id'));
        
        
        $request["method"] = $_SERVER['REQUEST_METHOD'];
        $request["request"] = explode("/", $_SERVER['REQUEST_URI']);
        
        $this->ApiAction = $request['request'][1];
        $this->ApiMethod = $request['method'];
        $params = array();
        
        switch ($this->ApiAction){
            case 'user' :
                $class = "User";
                break;
                
            case 'song' :
                $class = "Song";
                break;
                
            case 'playlist' :
                $class = "Playlist";
                break;
                
            default :
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
                echo '{"error" : "Action Not Found"}';
                return;
        }
        
        switch ($this->ApiMethod) {
            case 'GET' :
                $action = "Get";
                $params['id'] = $request['request'][2];
                $params['params'] = $_GET;
                break;
                
            case 'POST' :
                $action = "Create";
                $params['params'] = $_POST;
                break;
                
            case 'PUT' :
                $action = "Update";
                $params['id'] = $request['request'][2];
                $params['params'] = $_REQUEST;
                break;
                
            case 'DELETE' :
                $action = "Delete";
                $params['id'] = $request['request'][2];
                break;
                
            default :
                header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed");
                echo '{"error" : "Wrong Method"}';
                return;
        }
        
        $className = "Api_$class";
        $actionApi = $action.$class;
        
        $this->LoadClassApi($class);
        $ApiClass = new $className($params);    
        
        if(method_exists($ApiClass,$actionApi) == false){
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
            echo '{"error" : "Action Not Found"}';
            return;
        }else{
            $ApiClass->$actionApi();
        }
    }
    
    private function LoadClassApi($className){
        require API_PATH. "/$className.php";
    }
}