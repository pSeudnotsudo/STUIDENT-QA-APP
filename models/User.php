<?php
include_once __DIR__ . '/../config/db.php';

class User {
	private $conn;
	private $table = "users";

	public $id;
	public $firstname;
	public $lastname;
	public $email;
	public $username;
	public $password;
	public $created_at;

	public function __construct($db) {
		$this->conn = $db;
	}

	// create user
	public function register($firstname, $lastname, $email, $username, $phone, $password) {
		$query = "INSERT INTO " . $this->table . " (firstname, lastname, email, username, phone, password, created_at) 
				  VALUES (?, ?, ?, ?, ?, ?, ?)";
	
		$stmt = $this->conn->prepare($query);
	
		if (!$stmt) {
			die("Prepare failed: " . $this->conn->error);
		}
			
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$created_at = date("Y-m-d H:i:s");
	
		$stmt->bind_param("sssssss", $firstname, $lastname, $email, $username, $phone, $hashed_password, $created_at);
	
		if (!$stmt->execute()) {
			die("Execute failed: " . $stmt->error);
		}
	
		return true;
	}
	
	public function checkUserExists($email, $username) {
		$query = "SELECT id FROM " . $this->table . " WHERE email = ? OR username = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
	
		$stmt->bind_param("ss", $email, $username);
		$stmt->execute();
		$stmt->store_result();
	
		return $stmt->num_rows > 0;
	}

	// Authenticate user login
	public function login($email, $password) {
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
		
		if (!$stmt) {
			die("Prepare failed: " . $this->conn->error);
		}
	
		// Bind the email parameter
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

	
		if ($user) {	
			if (password_verify($password, $user['password'])) {
				echo "Password matches!";
				return $user;
			} else {
				echo "Password does not match!";
				return true;
			}
		} else {
			return false;
		}
	}	

	// public function verifyEmail
	public function verifyEmail($email) {
		$query = "SELECT id FROM " . $this->table . " WHERE email = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($this->id);
			$stmt->fetch();
			return true;
		}
		return false;
	}

	// public funtion update password
	public function updatePassword($email, $hashedPassword) {
		$query = "UPDATE " . $this->table . " SET password = ? WHERE email = ?";
	
		$stmt = $this->conn->prepare($query);
	
		$stmt->bind_param("ss", $hashedPassword, $email);

		return $stmt->execute();
	}

	 // Get User Details
	 public function getUserById($id) {
        $query = "SELECT id, firstname, lastname, username, email, phone FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

	// Update User Details
    public function updateUser() {
        $query = "UPDATE " . $this->table . " SET firstname = ?, lastname = ?, username = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->firstname, $this->lastname, $this->username, $this->email, $this->phone, $this->id);
        return $stmt->execute();
    }

	// Delete User Account
    public function deleteUser() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

	// Fetch All Users
	public function getAllUsers() {
    	$query = "SELECT id, firstname, lastname, username, email, phone FROM " . $this->table;
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$result = $stmt->get_result();
    
    	$users = [];
    	while ($row = $result->fetch_assoc()) {
	        $users[] = $row;
    	}
    	return $users;
	}
}

?>