<?php
require_once '../app/config/Database.php';
require_once '../app/models/User.php';
require_once '../app/controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        $userController->register();
    } elseif ($_POST['action'] == 'login') {
        $userController->login();
    }
}
?>
<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'register') {
        include '../app/views/register.php';
    } elseif ($_GET['page'] == 'login') {
        include '../app/views/login.php';
    }
} else {
    include '../app/views/login.php'; // default page
}

?>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $userController->logout();
}

?>