<?php
require MODEL_PATH."/User.php";
require API_PATH."/Abstract.php";

Class Api_User extends Api_Abstract{

    public function GetUser($data){
        $model = new Model_User();
        $data = $model->GetUser($data['id']);
        
        if($data){
            $this->returnData($data);
        }else{
            $this->handleError("User Not Found");
        }
    }
}