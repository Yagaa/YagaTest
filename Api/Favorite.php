<?php
require MODEL_PATH."/Favorite.php";
require API_PATH."/Abstract.php";

/**
 * 
 */
Class Api_Favorite extends Api_Abstract{

    public function GetFavorite(){
        $model = new Model_Favorite();
        $data = $model->GetFavorite($this->id);
        
        if($data){
            $this->returnData($data);
        }else{
            $this->handleError("Favorite Not Found");
        }
    }
    
    public function DeleteFavorite(){
        $data = array();
        $model = new Model_Favorite();
        if(isset($this->id) && isset($this->params['track_id'])){
            $songId = $this->params['track_id'];
            $delete = $model->DeleteSongFromFavorite($this->id,$songId);
            $data['message'] = "Song deleted from Favorite";
        }else{
            $this->handleError("Nothing was deleted");
        }
        if($delete == 1){
            $data['success'] = 1;
            $this->returnData($data);
        }else{
            $this->handleError("Nothing was deleted");
        }
    }
    
    public function CreateFavorite(){
        $data = array();
        $model = new Model_Favorite();
        if(isset($this->id) && isset($this->params['track_id'])){
            $songId = $this->params['track_id'];
            $create = $model->AddSongToFavorite($this->id,$songId);
            $data['message'] = "Song hase been added to Favorite";
        }else{
            // FUNCTON TO CREATE A Favorite
            $data['message'] = "Favorite created";
        }
        if($create == 1){
            $data['success'] = 1;
            $this->returnData($data);
        }else{
            $this->handleError("Nothing was created");
        }
    }
}