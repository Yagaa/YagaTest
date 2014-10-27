<?php
require MODEL_PATH."/Abstract.php";

Class Model_Song extends Model_Abstract {
    
    private $table = "song";

    public function GetSong($id){
        $query = "SELECT * FROM ".$this->table." WHERE id = ? ;";
        $row = $this->getRow($query, array($id));
        
        return $row;
    }

    public function DeleteSong($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        return $row;
    }
    
}
