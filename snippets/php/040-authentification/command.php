<?php

(php_sapi_name() == "cli") or die("Available only from command line interface");

require_once "lib.php";

# php command.php user create admin admin456 administrator
if(@$argv[1] == "user" && @$argv[2] == "create" && @$argv[3] != "" && @$argv[4] != ""){
    createUser(
        $argv[3], // username
        $argv[4], // password
        isset($argv[5])? explode(",", $argv[5]) : [] //roles
    );
}

# php command.php user login admin admin456
if(@$argv[1] == "user" && @$argv[2] == "login" && @$argv[3] != "" && @$argv[4] != ""){
    echo userLogin(
        $argv[3], // username
        $argv[4], // password
    ) ? "password is valid" :  "password is invalid";
}

# php command.php user delete admin
if(@$argv[1] == "user" && @$argv[2] == "delete" && @$argv[3] != ""){
    deleteUser(
        $argv[3], // username
    );
}

# php command.php user list
if(@$argv[1] == "user" && @$argv[2] == "list"){
    echo json_encode(loadStorage(
            "users"
        ), 
        JSON_PRETTY_PRINT
    );
}

# php command.php user get admin
if(@$argv[1] == "user" && @$argv[2] == "get" && @$argv[3] != ""){
    echo json_encode(getUser(
            $argv[3], // username
        ), 
        JSON_PRETTY_PRINT
    );
}

# php command.php password hash password123
if(@$argv[1] == "password" && @$argv[2] == "hash" && @$argv[3] != ""){
    echo getPasswordHash($argv[3]);
}

# php command.php storage get users
if(@$argv[1] == "storage" && @$argv[2] == "get" && @$argv[3] != ""){
    echo json_encode(loadStorage(
            $argv[3] // storage name
        ), 
        JSON_PRETTY_PRINT
    );
}

# php command.php help
if($argc == 0 || !in_array(@$argv[1], ["help", "user", "password", "storage"])) {
echo <<<END
help:
    php command.php user create USERNAME PASSWORD ROLE1,ROLE2
    php command.php user login USERNAME PASSWORD
    php command.php user delete USERNAME
    php command.php user list
    php command.php user get USERNAME
    php command.php password hash PASSWORD
    php command.php storage get users
END;
}
