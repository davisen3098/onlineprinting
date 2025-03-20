<?php
require_once '../../vendor/autoload.php';
require_once 'DBConnection.php';

class Option extends DBConnection {
    private $name;
    private $days;
    private $price;
    
    public function __construct($name, $days, $price) {
        parent::__construct();
        $this->name = $name;
        $this->days = $days;
        $this->price = $price;
    }

    public function addOption() {
        try {
            $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM options WHERE name = ?");
            if ($checkStmt === false) {
                throw new Exception($this->conn->error);
            }
            $checkStmt->bind_param("s", $this->name);
            $checkStmt->execute();
            $count = 0; 
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($count > 0) {
                return ["success" => false, "message" => "Option already exists"];
            }

            $stmt = $this->conn->prepare("INSERT INTO options (name, days, price) VALUES (?, ?, ?)");
            if ($stmt === false) {
                throw new Exception($this->conn->error);
            }
            $stmt->bind_param("sid", $this->name, $this->days, $this->price);
            $success = $stmt->execute();
            if ($success === false) {
                throw new Exception($stmt->error);
            }
            $stmt->close();
            return ["success" => true, "message" => "Option added successfully"];
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
