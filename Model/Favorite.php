<?php
require MODEL_PATH."/Abstract.php";

Class Model_Favorite extends Model_Abstract {
    
    private $table = "favorite";
    private $songTable = "song";

    public function GetFavorite($id){
        $query = "SELECT name FROM ".$this->table." f INNER JOIN ".$this->songTable." s ON s.id = f. song_FK WHERE f.user_FK = ? ;";
        $rows = $this->getRows($query, array($id));
        
        return $rows;
    }

    public function DeleteSongFromFavorite($userId,$songId){
        $query = "DELETE FROM ".$this->table." WHERE user_FK = ? AND song_FK = ? ;";
        $row = $this->deleteRow($query, array($userId,$songId));
        return $row;
    }
    
    public function AddSongToFavorite($userId,$songId){
        $query = "INSERT INTO ".$this->table." (user_FK,song_FK) VALUES (?,?);";
        $row = $this->insertRow($query, array($userId,$songId));
        return $row;
    }
}