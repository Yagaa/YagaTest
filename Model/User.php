<?php
require MODEL_PATH."/Abstract.php";

/**
 * Class DB for user table
 */
Class Model_User extends Model_Abstract {
    
    private $table = "user";

    /**
     * Get a user with user_id
     * @param int $id
     * @return array | false
     */
    public function GetUser($id){
        $query = "SELECT * FROM ".$this->table." WHERE id = ? ;";
        $row = $this->getRow($query, array($id));
        
        return $row;
    }

    /**
     * Delete a user with user_id
     * @param int $id
     * @return int | false
     */
    public function DeleteUser($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        
        return $row;
    }
}
