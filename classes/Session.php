<?php

class Session {
    
    // Start the session if not already started
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set a session variable
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Dynamic getter for session variables
    public function __get($key) {
        return $_SESSION[$key] ?? null; // Return the session value or null if not set
    }

    // Check if a session variable exists
    public function has($key) {
        return isset($_SESSION[$key]);
    }

    // Remove a session variable
    public function remove($key) {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    // Destroy the session
    public function destroy() {
        session_destroy();
        $_SESSION = []; // Reset session array
    }
}

?>
