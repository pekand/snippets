<?php

    function getUserPasswordHash($username) {

        $usersStorage = [
            'admin' => [
                'password' => password_hash("password", PASSWORD_BCRYPT, ['cost' => 12])
            ]
        ];

        if(!isset($usersStorage[$username])) {
            return null;
        }

        return $usersStorage[$username]['password'];
    }

    function userLogin($username, $password) {
        if($username != "" && $password != "") {
            $hash = getUserPasswordHash($username);
            if ($hash != null && password_verify($password, $hash)) {
                $_SESSION['user'] = [
                    'username' => $username
                ];
            };
        }
    }

    function checkIfUserIsLoggedIn() {

        if(isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    function redirectPage() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        header("Location: secret_page.php"); 
        die();
    }

    function checkOrResetCsrfToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
            (!isset($_POST['csrf_token']) || 
            !isset($_SESSION['csrf_token']) || 
            $_SESSION['csrf_token'] == null || 
            $_POST['csrf_token'] != $_SESSION['csrf_token'])
        ) {
            http_response_code(403);
            die;
        }

        if (!isset($_SESSION['csrf_token']) ||
            ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']))
        ) {
            $_SESSION['csrf_token'] = uniqid();
        }
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    checkOrResetCsrfToken();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_POST['csrf_token'])
    ) {
        userLogin($_POST['username'], $_POST['password']);
        redirectPage();
    }

    if (!checkIfUserIsLoggedIn()) {
        http_response_code(403);
        include "loginform.php";
        die;
    }
