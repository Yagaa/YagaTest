<?php

Class Route {
    
    public function __construct($params) {
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
    }
}