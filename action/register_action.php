<?php
session_start();
include_once "../settings/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate input fields
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Check for empty fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($dateOfBirth) || empty($password) || empty($confirmPassword) || empty($gender)) {
        $errors[] = "Please fill in all the required fields.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate password format
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($passwordRegex, $password)) {
        $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // Validate Ghanaian phone number format
    $ghanaPhoneRegex = '/^(?:(?:\+?233|233|0)(\d{9})|(?:233)(\d{9}))$/';
    if (!preg_match($ghanaPhoneRegex, $phoneNumber)) {
        $errors[] = "Please enter a valid Ghanaian phone number.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL query to insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, phone_number, DOB, password_hash, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $email, $phoneNumber, $dateOfBirth, $hashedPassword, $gender);
        $result = $stmt->execute();

        if ($result) {
            // Registration successful, redirect to login page
            $_SESSION['message'] = [
                'type' => 'success',
                'title' => 'Success!',
                'text' => 'Registration successful. You can now login.'
            ];
            header("Location: ../login/login.php");
            exit();
        } else {
            // Registration failed
            $errors[] = "Registration failed. Please try again later.";
        }
    }

    // If there are errors, redirect back to registration page with error messages
    $_SESSION['message'] = [
        'type' => 'error',
        'title' => 'Error!',
        'text' => implode("<br>", $errors)
    ];
    header("Location: ../register/register.php");
    exit();
} else {
    // If request method is not POST, redirect to registration page
    $_SESSION['message'] = [
        'type' => 'error',
        'title' => 'Error!',
        'text' => 'Invalid request method.'
    ];
    header("Location: ../register/register.php");
    exit();
}
?>
