<?php

namespace App\Lib\Repositories;

class UserRepository implements UserRepositoryContract
{
    public function __construct($param = "") {

    }

    public function getUsers() {
        $users = \App\Models\User::get();
        return $users;
    }
}
