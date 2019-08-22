<?php
namespace Model;

class Account
{
    public $id;
    public $user_name;
    public $password;
    public $role;

    public function __construct($id, $user_name, $password, $role)
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->role = $role;
    }
}
