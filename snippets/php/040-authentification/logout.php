<?php

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

    logout();
