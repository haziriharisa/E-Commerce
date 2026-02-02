<?php
require_once 'Database.php';
require_once 'User.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $role  = $_POST['role']; 
    $result = $user->create($fname, $lname, $email, $pass, $role);

    if ($result === true) {
        $message = "<p style='color:green;'>Registration successful!</p>";
    } else {
        $message = "<p style='color:red;'>$result</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/signup.css">

    <title>Solora</title>
</head>
<body>
   <div class="login-container">
    <div class="login-box">
        <h1>Sign Up</h1>
        <?php echo $message; ?>
        <form style="margin-top:0px;" class="form" method="POST" action="">
            <div class="name">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <input class="email-input" type="email" name="email" placeholder="Enter your email" required>
            <div class="role">
                <input type="password" name="password" placeholder="Password" required>
                <select class="user" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="check">
                <input type="checkbox" required>
                <label>I Agree to the Terms of Service</label>
            </div>
            <div class="sign">
                <button type="submit" class="login_btn">Sign Up</button>
                <p class="signup">Already have an account? <a href="login.php">Sign in</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>