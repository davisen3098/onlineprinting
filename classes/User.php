<?php

require_once('../config.php');

class User extends DBConnection {
    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    
    private $confirmPassword;
    private $email;
    private $street;
    private $town;
    private $phone;


    public function __construct($firstName, $lastName, $userName, $password, $email, $street, $town , $phone) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->street = $street;
        $this->town = $town;
        $this->phone = $phone;
        parent::__construct();
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public static function load($id) {
        $db = new DBConnection();  
        $conn = $db->conn; 

        $sql = "SELECT * FROM customer WHERE id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row['firstname'], $row['lastname'], $row['username'], $row['password'], $row['email'], $row['street'], $row['town'], $row['phone']);
        } else {
            return null;
        }
    }

    public function register() {
        $sql = "INSERT INTO customer (firstname, email, password, phone, street, username, lastname, town) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error); // update to handle error properly
        }

        // Bind parameters
        $stmt->bind_param("ssssssss", $this->firstName, $this->email, $this->password, $this->phone, $this->street, $this->userName, $this->lastName, $this->town);

        // Execute statement
        $result = $stmt->execute();

        //TODO: handle error properly
        if ($result) {
            echo "User inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    public static function isUserExist($email, $password) {
        $db = new DBConnection();  
        $conn = $db->conn; 
    
        // SQL query to fetch the user ID
        $sql = "SELECT id FROM customer WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error); // Handle error if prepare fails
        }
    
        // Bind parameters
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();  // Store result to use num_rows
    
        // Check if there are rows matching the query
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId);  // Bind the result to fetch the user ID
            $stmt->fetch();  // Fetch the first row
            return ['status' => true, 'id' => $userId];
        }
    
        // If no rows were found, return false
        return ['status' => false]; 
    }
    
    
}