<?php

// convert data from storage (database, array) to object. User row from table to entity object user.

class User {
    private $username;
    private $email;

    public static function fromState(array $state): User {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function __construct(string $username, string $email) {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }
}


class UserMapper {
    private $storage;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    public function findById(int $id): User {
        $result = $this->storage->find($id);

        if (empty($result)) {
            return null;
        }

        return $this->mapRowToUser($result);
    }

    private function mapRowToUser(array $row): User {
        return User::fromState($row);
    }
}

class Storage { // represent database storage
    private $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function find(int $id) {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}

$storage = new Storage(
	[
		1 => [
			'username' => 'name', 
			'email' => 'name@gmail.com'
		]
	]
);

$mapper = new UserMapper($storage);
$user = $mapper->findById(1);
print_r($user);
        
             
