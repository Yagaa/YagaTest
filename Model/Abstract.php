<?php
class Model_Abstract {

    public $isConnected;
    protected $datab;

    public function __construct() {
        $configs = parse_ini_file(CONF_PATH."/database.ini");
        $this->isConnected = true;
        try {
            $this->datab = new PDO("mysql:host={$configs['db.host']};dbname={$configs['db.dbname']};charset=utf8", $configs['db.username'], $configs['db.password'],array());
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->isConnected = false;
            throw new Exception($e->getMessage());
        }
    }

    public function Disconnect() {
        $this->datab = null;
        $this->isConnected = false;
    }

    public function getRow($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getRows($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insertRow($query, $params) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateRow($query, $params) {
        return $this->insertRow($query, $params);
    }

    public function deleteRow($query, $params) {
        return $this->insertRow($query, $params);
    }

}
