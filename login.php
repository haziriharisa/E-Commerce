<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
   <div class="login-container">
    <div class="form-container">
        <h1>Welcome Back</h1>
        <p class="detail">Please enter your details.</p>
        
        <form action="login_action.php" class="form-section" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="remember">
                <div class="check">
                    <input type="checkbox" name="remember">
                    <label>Remember Me</label>
                </div>
                <a href="forgot.html">Forgot Password</a>
            </div>
            
            <button type="submit" class="login_btn">Login</button>
            
        </form>
        
        <p class="signup">Don't have an account? <a href="signup.php">Sign up for free</a></p>
    </div>
    </div>
</div>
</body>
</html>