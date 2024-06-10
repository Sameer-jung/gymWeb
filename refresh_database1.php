<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['refresh_database'])) {
        // Truncate the users table to remove all data
        $truncateSql = "TRUNCATE TABLE users";
        mysqli_query($conn, $truncateSql);

        // Insert sample data into the users table
        $insertSql = "INSERT INTO users (username, email, phone, age, experience, program, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        $password = password_hash("password123", PASSWORD_DEFAULT); // Hashed password

        // Sample user data
        $sampleUsers = array(
            array("admin", "admin@example.com", "1234567890", 30, "advanced", "karate", $password, "admin"),
            array("user1", "user1@example.com", "9876543210", 25, "beginner", "taekwondo", $password, "user"),
            // Add more sample user data if needed
        );

        foreach ($sampleUsers as $user) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7]);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);

        echo "Database refreshed successfully.";
    }
}
?>

<!-- HTML Form to trigger the database refresh -->
<form action="refresh_database.php" method="post">
    <button type="submit" name="refresh_database">Refresh Database</button>
</form>
