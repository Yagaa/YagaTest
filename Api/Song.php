<?php
require MODEL_PATH."/Song.php";
require API_PATH."/Abstract.php";

Class Api_Song extends Api_Abstract{

    public function GetSong(){
        $model = new Model_Song();
        $data = $model->GetSong($this->id);
        
        if($data){
            $this->returnData($data);
        }else{
            $this->handleError("Song Not Found");
        }
    }

    public function DeleteSong(){
        $data = array();
        $model = new Model_Song();
        $delete = $model->DeleteSong($this->id);
        if($delete == 1){
            $data['success'] = 1;
            $data['message'] = "Song deleted";
            $this->returnData($data);
        }else{
            $this->handleError("Song Not Found");
        }
    }
}