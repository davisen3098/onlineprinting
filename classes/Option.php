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

    public static function getOptions() {
        try {
            $conn = new DBConnection();
            $stmt = $conn->conn->prepare("SELECT * FROM options");
            if ($stmt === false) {
                throw new Exception($conn->conn->error);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $options = [];
            while ($row = $result->fetch_assoc()) {
                $options[] = $row;
            }
            $stmt->close();
            return $options;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public static function getOption($id) {
        try {
            $conn = new DBConnection();
            $stmt = $conn->conn->prepare("SELECT * FROM options WHERE id = ?");
            if ($stmt === false) {
                throw new Exception($conn->conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $option = $result->fetch_assoc();
            $stmt->close();
            return $option;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public static function updateOption($id, $name, $days, $price) {
        try {
            $conn = new DBConnection();
            $stmt = $conn->conn->prepare("UPDATE options SET name = ?, days = ?, price = ? WHERE id = ?");
            if ($stmt === false) {
                throw new Exception($conn->conn->error);
            }
            $stmt->bind_param("sidi", $name, $days, $price, $id);
            $success = $stmt->execute();
            if ($success === false) {
                throw new Exception($stmt->error);
            }
            $stmt->close();
            return ["success" => true, "message" => "Option updated successfully"];
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
