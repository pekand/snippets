<?php

namespace App\Lib\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Users\User;

class UserRepository implements UserRepositoryContract
{
    public function __construct($param = "") {

    }

    public function getUsers() {
        $users = User::get();

        Log::info("Request ".$requestUid);

        return $users;
    }
}
