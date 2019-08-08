<?php
namespace Database;
define('SERVER_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'basic1');

use Model\Account;

include_once('Model/Account.php');

class Database {
    private $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);

        if ($this->connection->connect_error) {
            die('Connection failed');
        }
    }

    public function close()
    {
        $this->connection->close();
    }

    public function checkUserName($user_name){
        $sql = 'SELECT * FROM accounts where user_name = "' . $user_name . '"';
        $result = mysqli_query($this->connection, $sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function storeUser($full_name, $birth, $user_name, $password){
        $hash_password = md5($password);
        try {
            $this->connection->begin_transaction();
            $sql = 'INSERT INTO accounts VALUES(null,"' . $user_name . '","' . $hash_password . '", DEFAULT)';
            mysqli_query($this->connection, $sql);
            $id = $this->connection->insert_id;
            $sql = 'INSERT INTO users VALUES(null,"' . $full_name . '", null, "' . $birth . '",' . $id . ')';
            mysqli_query($this->connection, $sql);
            $this->connection->commit();

            return true;
        } catch (\Exception $e) {
            $this->connection->rollback();

            return false;
        }
    }

    public function checkLogin($user_name, $password){
        $hash_password = md5($password);
        $sql = 'SELECT * FROM accounts WHERE user_name="' . $user_name . '"';
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (hash_equals($hash_password, $row['password'])) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function getInfo($account_id){
        $sql = 'SELECT * FROM users WHERE account_id="' . $account_id . '"';
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }
}
