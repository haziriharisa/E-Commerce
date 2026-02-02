<?php
class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }
    public function create($fname, $lname, $email, $pass, $role) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() > 0) {
            return "Email already registered.";
        }

        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        if($stmt->execute([$fname, $lname, $email, $hashed_password, $role])) {
            return true;
        }
        return false;
    }
   

    public function login($email, $password) {
        $query = "SELECT id, first_name, last_name, password, role FROM " . $this->table_name . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($password, $row['password'])) {
                
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];
                $_SESSION['user_role'] = $row['role']; 
                
                return $row['role']; 
            }
        }
        return false; 
    }
}

?>
