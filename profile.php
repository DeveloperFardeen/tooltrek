<?php
// profile.php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['userEmail'])) {
    // Redirect to login page if not authenticated
    header('Location: login.php');
    exit;
}

include 'db/conn.php';

// Fetch user details
$userEmail = $_SESSION['userEmail'];
$sql = "SELECT name, email, course, interests FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .logout {
            display: block;
            text-align: center;
            margin: 20px 0;
        }
        .logout a {
            color: #fff;
            background: #333;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($user['course']); ?></p>
        <p><strong>Interests:</strong> <?php echo htmlspecialchars($user['interests']); ?></p>
        <div class="logout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</body>
</html>
