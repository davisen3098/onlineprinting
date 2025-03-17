<?php
require_once '../config.php'; // Ensure this file contains your database connection

class SupplierEdit extends DBConnection {
    private $supplierID;
    private $supplierData = [];

    public function __construct($db, $supplierID) {
        $this->conn = $db;
        $this->supplierID = $supplierID;
        $this->fetchSupplierData();
    }

    private function fetchSupplierData() {
        $sql = "SELECT * FROM supplier WHERE SupplierID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->supplierID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->supplierData = $result->fetch_assoc();
        }
    }

    public function getSupplierData() {
        return $this->supplierData;
    }

    public function updateSupplier($name, $email, $phone, $companyName, $address) {
        $sql = "UPDATE supplier SET Name = ?, Email = ?, Phone = ?, CompanyName = ?, Address = ? WHERE SupplierID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $email, $phone, $companyName, $address, $this->supplierID);

        return $stmt->execute();
    }
}
