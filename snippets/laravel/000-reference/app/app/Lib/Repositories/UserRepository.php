<?php

namespace App\Lib\Repositories;

use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryContract
{
    public function __construct($param = "") {

    }

    public function getUsers() {
        $users = \App\Models\User::get();

        Log::info("Request ".$requestUid);

        return $users;
    }
}
