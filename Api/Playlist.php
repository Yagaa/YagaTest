<?php
require MODEL_PATH."/Playlist.php";
require API_PATH."/Abstract.php";

Class Api_Playlist extends Api_Abstract{

    public function GetPlaylist(){
        $model = new Model_Playlist();
        $data = $model->GetPlaylist($this->id);
        
        if($data){
            $this->returnData($data);
        }else{
            $this->handleError("User Not Found");
        }
    }
}