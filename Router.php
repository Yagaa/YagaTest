<?php

/**
 * Router class to dispatch actions and prepare params
 * @author Jeyaganesh RANJIT <jeyaganesh.ranjit@gmail.com>
 */
Class Router {

    private $ApiController = "";
    private $routesAllowed = array(
        "User", "Song", "Favorite"
    );
    private $methodsAllowed = array(
        "GET" => "Get",
        "POST" => "Create",
        "DELETE" => "Delete"
    );

    /**
     * This method call the good Api with all params
     * But he reject all wrong Api Call (Api name or Method request)
     * @author Jeyaganesh RANJIT <jeyaganesh.ranjit@gmail.com>
     */
    public function init() {

        $request["method"] = $_SERVER['REQUEST_METHOD'];
        $request["request"] = explode("/", $_SERVER['REQUEST_URI']);

        $this->CheckMethodRequest($request["method"]);

        $params = $this->prepareParams($request["method"], $request['request']);

        $this->ApiController = ucfirst(strtolower($request['request'][1]));


        /* Prepare the Action for Api witj request method and Api name 
         * (ex : if request method is GET And Api name is User => GetUser)
         */
        $this->ApiAction = $this->methodsAllowed[$request['method']] . $this->ApiController;

        // Check if Api called is allowed
        if (in_array($this->ApiController, $this->routesAllowed)) {

            // Get Output type if it passed in URI
            $output = isset($params['params']['output']) ? $params['params']['output'] : false;

            $this->LoadClassApi($this->ApiController);

            // Initiate an instance of Api
            $className = "Api_" . $this->ApiController;
            $ApiClass = new $className($params, $output);

            // Check if action exist in Api class
            if (method_exists($ApiClass, $this->ApiAction)) {

                call_user_func_array(array($ApiClass, $this->ApiAction), $params);
            } else {
                header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
                echo '{"error" : "Wrong Method"}';
                return;
            }
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            echo '{"error" : "Action Not Found"}';
            return;
        }
    }

    /**
     * Include an Api Class
     * @param string $className
     */
    private function LoadClassApi($className) {
        require API_PATH . "/$className.php";
    }

    /**
     * Check if the request method is allowed
     * @param string $method REQUEST_METHOD
     */
    private function CheckMethodRequest($method) {
        if (!isset($this->methodsAllowed[$method])) {
            header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
            echo '{"error" : "Wrong Method"}';
            exit;
        }
    }

    /**
     * Prepare Data according to Request Method
     * @param string $method REQUEST_METHOD
     * @param string $request REQUEST_URI
     * @return type
     */
    private function prepareParams($method, $request) {
        switch ($method) {
            case 'GET' :
                $params['id'] = $request[2];
                $params['params'] = $_GET;
                break;

            case 'POST' :
                $params['id'] = isset($request[2]) ? $request[2] : "";
                $params['params'] = $_POST;
                break;

            case 'DELETE' :
                $params['id'] = $request[2];
                if (isset($request[3]) && is_numeric($request[3])) {
                    $params['params'] = array("track_id" => $request[3]);
                }
                break;
        }

        return $params;
    }

}