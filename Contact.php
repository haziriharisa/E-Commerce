<?php
class Contact {
    private $conn;
    private $table = "contact_messages";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function saveMessage($fName, $lName, $email, $mobile, $message) {
        $query = "INSERT INTO " . $this->table . " 
                  SET first_name=:fname, last_name=:lname, email=:email, mobile=:mobile, message=:message";
        
        $stmt = $this->conn->prepare($query);

        $fName = htmlspecialchars(strip_tags($fName));
        $lName = htmlspecialchars(strip_tags($lName));
        $email = htmlspecialchars(strip_tags($email));
        $mobile = htmlspecialchars(strip_tags($mobile));
        $message = htmlspecialchars(strip_tags($message));

        $stmt->bindParam(":fname", $fName);
        $stmt->bindParam(":lname", $lName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":mobile", $mobile);
        $stmt->bindParam(":message", $message);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>