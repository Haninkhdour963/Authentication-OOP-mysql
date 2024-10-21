<?php
class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->userModel->register($username, $password);
            header("Location: /public/login.php");
        }
    }

    public function login() {
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->login($username, $password);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                header("Location: /public/dashboard.php");
            } else {
                echo "Login failed";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /public/login.php");
    }
}
?>
