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
    
    public function DeletePlaylist(){
        $data = array();
        $model = new Model_Playlist();
        if(isset($this->id) && isset($this->params['chield_id'])){
            $songId = $this->params['chield_id'];
            $delete = $model->DeleteSongFromPlaylist($this->id,$songId);
            $data['message'] = "Song deleted from Playlist";
        }else{
            $delete = $model->DeletePlaylist($this->id);
            $data['message'] = "Playlist deleted";
        }
        if($delete == 1){
            $data['success'] = 1;
            $this->returnData($data);
        }else{
            $this->handleError("Nothing was deleted");
        }
    }
    
    public function UpdatePlaylist(){
        
    }
}