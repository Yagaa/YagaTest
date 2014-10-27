<?php
require MODEL_PATH."/Abstract.php";

Class Model_User extends Model_Abstract {
    
    private $table = "user";

    public function GetUser($id){
        $query = "SELECT * FROM ".$this->table." WHERE id = ? ;";
        $row = $this->getRow($query, array($id));
        
        return $row;
    }

    public function DeleteUser($id){
        $query = "DELETE FROM ".$this->table." WHERE id = ? ;";
        $row = $this->deleteRow($query, array($id));
        
        return $row;
    }
}
