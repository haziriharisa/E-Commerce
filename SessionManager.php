<?php
class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($user_id) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['cart'] = [];

    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

  public function logout() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

    session_unset();
    session_destroy();
}
}