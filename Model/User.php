<?php
namespace Model;

class User {
    public $id;
    public $full_name;
    public $address;
    public $birth;
    public $account_id;

    public function __construct($id, $full_name, $address, $birth, $account_id)
    {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->address = $address;
        $this->birth = $birth;
        $this->account_id = $account_id;
    }
}
