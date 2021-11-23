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

    function checkIfUserIsLoggedIn($username, $passwod) {
        if($username != "" && $passwod != "") {
            $hash = getUserPasswordHash($username);
            if ($hash != null && password_verify($passwod, $hash)) {
                $_SESSION['user'] = [
                    'username' => $username
                ];
            };
        }

        if(isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!checkIfUserIsLoggedIn(@$_POST['username'], @$_POST['password'])) {
        http_response_code(403);
        include "loginform.php";
        die;
    }
