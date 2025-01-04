<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
           session_start();
           $_SESSION['userName'] = $user['name'];
           $_SESSION['userEmail'] = $email;
           header('Location: profile.php');          
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/custom.css">
	<meta name="robots" content="noindex, follow">
</head>

	<body>

		<div class="wrapper">
			<div class="inner">
                <div class="image-holder">
                    <img src="images/login.jpeg" alt="">
				</div>
                <form method="POST" action="">
                    <h3>Tooltrek - Login</h3>
                    <div class="form-wrapper">
                        <input type="email" id="email" name="email" placeholder="Email Address" class="form-control" required>
                        <i class="zmdi zmdi-email"></i>
                    </div>
                    <div class="form-wrapper">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                        <i class="zmdi zmdi-lock"></i>
                    </div>
                    <button type="submit">Login
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                    <br>
                    <br>
                    <p>Don't have an account? <a href="signup.php">Sing Up</a></p>
                    <p>Return to <a href="index.html">Home</a> page.</p>
                </form>
			</div>
		</div>
		
</body>
</html>