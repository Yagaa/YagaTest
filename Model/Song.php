<?php
require MODEL_PATH."/Abstract.php";

/**
 * Class DB for song table
 */
Class Model_Song extends Model_Abstract {
    
    private $table = "song";

    /**
     * Get a song with song_id
     * @param int $id
     * @return array | false
     */
    public function GetSong($id){
        $query = "SELECT * FROM ".$this->table." WHERE id = ? ;";
        $row = $this->getRow($query, array($id));
        
        return $row;
    }

    
    /**
     * Delete a song with song_id
     * @param int $id
     * @return int | false
     */
    public function DeleteSong($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        
        return $row;
    }
    
}
