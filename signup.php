
<!-- signup.php -->
<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    $interests = $conn->real_escape_string(implode(", ", $_POST['interests']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $checkEmail = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        header('Location: login.php');
    } else {
        $sql = "INSERT INTO users (name, email, course, interests, password) VALUES ('$name', '$email', '$course', '$interests', '$password')";
        if ($conn->query($sql) === TRUE) {
           session_start();
           $_SESSION['userName'] = $name;
           $_SESSION['userEmail'] = $email;
           header('Location: profile.php');
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign Up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/custom.css">

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="robots" content="noindex, follow">
</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<div class="image-holder">
					<img class="signup-img" src="images/signup.png" alt="">
				</div>
				<form method="POST" action="">
					<h3>Tooltrek - Sign Up</h3>
					<div class="form-group">
						<input type="text" id="name" name="name" placeholder="Enter Your Name" class="form-control" required>
					</div>
					<div class="form-wrapper">
						<input type="text" id="email" name="email" placeholder="Email Address" class="form-control" required>
					</div>
					<div class="form-wrapper">
						<input type="text" id="course" name="course" placeholder="Course you are pursuing" class="form-control" required>
					</div>
					<div class="form-wrapper">
                        <p>Interests</p>
                        <input type="checkbox" name="interests[]" value="Tech">Tech&nbsp;
                        <input type="checkbox" name="interests[]" value="Travel">Travel&nbsp;
                        <input type="checkbox" name="interests[]" value="Art">Art&nbsp;
                        <input type="checkbox" name="interests[]" value="Cooking">Cooking&nbsp;
                        <input type="checkbox" name="interests[]" value="Fitness">Fitness<br>
                        <input type="checkbox" name="interests[]" value="Food">Food&nbsp;
                        <input type="checkbox" name="interests[]" value="Movies">Movies&nbsp;
                        <input type="checkbox" name="interests[]" value="Music">Music&nbsp;
                        <input type="checkbox" name="interests[]" value="Dancing">Dancing<br>
                        <input type="checkbox" name="interests[]" value="Books">Books&nbsp;
                        <input type="checkbox" name="interests[]" value="Writing">Writing&nbsp;
                        <input type="checkbox" name="interests[]" value="Photography">Photography&nbsp;
                        <input type="checkbox" name="interests[]" value="Fashion">Fashion<br>
                        <input type="checkbox" name="interests[]" value="Gaming">Gaming&nbsp;
                        <input type="checkbox" name="interests[]" value="Sports">Sports&nbsp;
                        <input type="checkbox" name="interests[]" value="Mindfulness">Mindfulness&nbsp;
                        <input type="checkbox" name="interests[]" value="Science">Science<br>
					</div>
                    <br>
					<div class="form-wrapper">
						<input type="password" id="password" name="password" placeholder="Create Password" class="form-control" required>
					</div>
					<button type="submit">Sign Up
						<i class=""></i>
					</button>
                    <br>
                    <br>
                    <p>Already have an account? <a href="login.php">Login</a></p>
                    <p>Return to <a href="index.html">Home</a> page.</p>
				</form>
			</div>
		</div>
		
        <script>
            if (window.innerWidth < 767) {
                document.querySelector('.signup-img').style.display = "none";
            }
        </script>
    </body>
</html>