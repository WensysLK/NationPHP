<?php
session_start();
include('../includes/db_config.php'); // Include your database connection file

if (isset($_POST['submit'])) {
    $username_email = mysqli_real_escape_string($conn, $_POST['username_email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the user exists with the given username/email
    $sql = "SELECT u.userID, u.Username, u.Email, u.password, u.userRoleID, r.UserRoleName 
            FROM users u 
            JOIN userrole r ON u.userRoleID = r.UserRoleID
            WHERE u.Username = ? OR u.Email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_email, $username_email); // Bind the username or email
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password (assuming passwords are not hashed)
        if ($password === $row['password']) {
            // Set session variables
            $_SESSION['session_name'] = $row['Username'];     // Username
            $_SESSION['session_id'] = $row['userID'];         // User ID
            $_SESSION['session_role_id'] = $row['userRoleID']; // User role ID
            $_SESSION['session_role_name'] = $row['UserRoleName']; // Role name
            
            // Redirect to dashboard or any protected page
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            // Password doesn't match
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }
    } else {
        // User doesn't exist
        $_SESSION['error'] = "Invalid username/email or password!";
        header("Location: ../index.php");
    }
} else {
    // If the form is not submitted
    header("Location: ../index.php");
}
?>
