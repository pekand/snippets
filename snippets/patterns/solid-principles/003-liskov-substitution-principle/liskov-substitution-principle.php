<?php

// Liskov substitution principle
// on a place where is used parent class must be usable all inherited classies
// inheritance not only based on similar attributes 
// square is not child of rectanglel -> square and rectangle are shape; 
// if bird can fly -> pinguin is not bird bicouse pinguin dont fly (Is SwimingBird)
// duck on batteries is not duck; 

class User 
{
    private string $name;
    private string $email;
    
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->$email = $email;
    }
    
    function getName(){
        
    }
    
    function getEmail(){
        
    }
}

class AdminUser 
{
    private string $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

class UserRepository
{   
    public function fetchUser()
    {
        return new User("user", "user@mail.com");
    }
}

//this break Liskov substitution principle. Maybe this repository works on some places in code but must work with all places where UserRepository is used
class AdminUserRepository extends UserRepository // is inherited from UserRepository but is not compatible 
{   
    public function fetchUser()
    {
        return new AdminUser("admin"); // Admin user dont has email adress
    }
}

class UserManager
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function sendEmailToUser(string $name)
    {
        $user = $this->userRepository->fetchUser($name);
        $email = $user->getEmail(); // admin dont has email -> fatal error 
        //send email to user
    }
}

// if AdminUserRepository is used in UserManager cause fatal error 
$userRepository = new AdminUserRepository();
$userManager = new UserManager($userRepository);
$userManager->sendEmailToUser("admin");