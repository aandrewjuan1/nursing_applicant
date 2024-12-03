<?php
require_once(__DIR__ . '/../Core/Database.php');



class User extends Database {

    // Helper function to validate email
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Helper function to validate password strength
    private function validatePassword($password) {
        // Minimum 8 characters, at least one uppercase, one lowercase, one number, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    // Helper function to validate username
    private function validateUsername($username) {
        // Alphanumeric usernames, between 3-50 characters
        return preg_match('/^[a-zA-Z0-9]{3,50}$/', $username);
    }

    public function register($username, $email, $password, $confirmPassword) {
        // Check if passwords match
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }
    
        // Check password strength
        if (strlen($password) < 8) {
            return "Password must be at least 8 characters long.";
        }
    
        try {
            $stmt = $this->connect()->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Secure password hash
            $stmt->execute([$username, $email, $passwordHash]);
            return "Registration successful!";
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { // Duplicate entry error
                return "Username or email already exists.";
            }
            return "An error occurred: " . $e->getMessage();
        }
    }
    

    // Login a user
    public function login($usernameOrEmail, $password) {
        try {
            // Validate inputs
            if (!$this->validateEmail($usernameOrEmail) && !$this->validateUsername($usernameOrEmail)) {
                return "Invalid username or email format.";
            }

            $conn = $this->connect();
            $sql = "SELECT * FROM users WHERE username = :usernameOrEmail OR email = :usernameOrEmail";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':usernameOrEmail' => $usernameOrEmail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                // Start session and set user data
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return "Login successful!";
            } else {
                return "Invalid credentials!";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

     // Method to log out the user by destroying the session
     public function logout() {
        // Destroy the session
        session_start();
        session_unset();  // Unset all session variables
        session_destroy();  // Destroy the session itself
    }
}
