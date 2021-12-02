<?php

function loadStorage($storageName) {
    $fileContent = file_get_contents("storage/".$storageName.".json");
    return json_decode($fileContent, true);
}

function saveStorage($storageName, $data) {
    $json = json_encode($data);
    file_put_contents("storage/".$storageName.".json", $json);
}

function getPasswordHash($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function createUser($username, $password, $roles = []) {
    $users = loadStorage("users");
    $users[$username] = [
        'password' => getPasswordHash($password),
        'roles' => $roles
    ];
    saveStorage("users", $users);
}

function deleteUser($username) {
    $users = loadStorage("users");
    unset($users[$username]);
    saveStorage("users", $users);
}

function getUser($username) {

    $usersStorage = loadStorage("users");

    if(!isset($usersStorage[$username])) {
        return null;
    }

    return $usersStorage[$username];
}

function userLogin($username, $password) {
    if($username != "" && $password != "") {
        $user = getUser($username);
        if ($user['password'] != null && password_verify($password, $user['password'])) {
            $_SESSION['csrf_token'] = uniqid();
            $_SESSION['user'] = [
                'username' => $username,
                'roles' => $user['roles']
            ];
            return true;
        };
    }

    return false;
}

function checkIfUserIsLoggedIn() {

    if(isset($_SESSION['user'])) {
        return true;
    }

    return false;
}

function redirectPage($page = "secret_page.php") {
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }

    header("Location: ".$page); 
    die();
}

function checkOrSetCsrfToken() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
        (!isset($_POST['csrf_token']) || 
        !isset($_SESSION['csrf_token']) || 
        $_SESSION['csrf_token'] == null || 
        $_POST['csrf_token'] != $_SESSION['csrf_token'])
    ) {
        http_response_code(403);
        die;
    }

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = uniqid();
    }
}

function logout() {
    session_start();
    $_SESSION = [];
    session_destroy();

    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }

    header("Location: secret_page.php"); 
    die();
}

function protectPage() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    checkOrSetCsrfToken();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['username']) &&
        isset($_POST['password'])
    ) {
        userLogin($_POST['username'], $_POST['password']);
        redirectPage();
    }

    if (!checkIfUserIsLoggedIn()) {
        http_response_code(403);
        include "loginform.php";
        die;
    }
}
