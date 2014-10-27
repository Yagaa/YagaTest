<?php
require MODEL_PATH."/Abstract.php";

Class Model_Playlist extends Model_Abstract {
    
    private $table = "playlist";

    public function GetPlaylist($id){
        $query = "SELECT * FROM ".$this->table." WHERE id = ? ;";
        $row = $this->getRow($query, array($id));
        
        return $row;
    }

    public function DeletePlaylist($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        return $row;
    }

    public function DeleteSongFromPlaylist($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        return $row;
    }
}