<?php

class Auth {
    public function checkAuthentication() {
        session_start();
        
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            header("Location: index.php");
            exit();
        }
    }
    
    public function ensureAuthenticated() {
        session_start();
        
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
    }
}
