<?php
// handle_register.php - v2 - User-friendly error handling with sessions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Store user input in session to repopulate the form on error ---
    $_SESSION['form_input'] = $_POST;

    // --- 2. Validate Input ---
    // Check for duplicate email
    $stmt_check = $connection->prepare("SELECT email FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $_POST['email']);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Instead of die(), set a session error and redirect back
        $_SESSION['register_error'] = "This email address is already registered.";
        header("Location: register");
        exit();
    }

    // Check if passwords match
    if ($_POST['password'] !== $_POST['confirm_password']) {
        // Instead of die(), set a session error and redirect back
        $_SESSION['register_error'] = "The passwords you entered do not match.";
        header("Location: register");
        exit();
    }

    // --- 3. Process valid data ---
    // --- 3. Process valid data ---
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Updated INSERT with new fields
    $stmt_insert = $connection->prepare("INSERT INTO users (first_name, last_name, email, company, password, phone_number, address_street, address_city, address_country, address_zip, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters (s = string, there are 11 strings)
    $stmt_insert->bind_param(
        "sssssssssss",
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['company'],
        $hashed_password,
        $_POST['phone_number'],
        $_POST['address_street'],
        $_POST['address_city'],
        $_POST['address_country'],
        $_POST['address_zip'],
        $_POST['dob']
    );

    if ($stmt_insert->execute()) {
        // Success! Clear any old form input and redirect to login with a success message.
        unset($_SESSION['form_input']);
        unset($_SESSION['register_error']);
        header("Location: login?registration=success");
        exit();
    } else {
        // Handle unexpected database error
        $_SESSION['register_error'] = "A database error occurred. Could not register the user.";
        header("Location: register");
        exit();
    }

} else {
    // Redirect if accessed directly
    header("Location: register");
    exit();
}
?>