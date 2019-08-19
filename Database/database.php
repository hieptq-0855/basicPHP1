<?php
namespace Database;
define('SERVER_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'basic1');

use Model\Account;
use PDO;
use PDOException;
use Model\User;

include_once ('Model/User.php');
include_once('Model/Account.php');

class Database {
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost', USER_NAME, PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        try {
            $sql = 'USE ' . DB_NAME;
            $this->connection->exec($sql);
        } catch (PDOException $e) {
            $this->createDB();
        }
    }

    public function close()
    {
        $this->connection = null;
    }

    public function checkUserName($user_name){
        $sql = 'SELECT * FROM accounts where user_name = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_name]);
        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function storeUser($full_name, $birth, $user_name, $password){
        $hash_password = md5($password);
        try {
            $this->connection->beginTransaction();
            $sql = 'INSERT INTO accounts VALUES(null, ?, ?, DEFAULT)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user_name, $hash_password]);
            $id = $this->connection->lastInsertId();
            $sql = 'INSERT INTO users VALUES(null, ?, null, ?, ?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$full_name, $birth, $id]);
            $this->connection->commit();

            return true;
        } catch (\Exception $e) {
            $this->connection->rollBack();

            return false;
        }
    }

    public function checkLogin($user_name, $password){
        $hash_password = md5($password);
        $sql = 'SELECT * FROM accounts WHERE user_name = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_name]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
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
        $sql = 'SELECT * FROM users WHERE account_id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$account_id]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            return $row;
        } else {
            return false;
        }
    }
    public function getUserInformationList(){
        try {
            $sql = 'SELECT users.*, accounts.user_name FROM users INNER JOIN accounts ON users.account_id = accounts.id WHERE accounts.role = 1';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function findUser($id){
        try {
            $sql = 'SELECT * FROM users WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();

                return $result;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function doUpdateUser($id, $full_name, $address, $birth){
        try {
            $sql = 'UPDATE users SET full_name = ?, address = ?, birth = ? WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$full_name, $address, $birth, $id]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteUser($id){
            $user = $this->findUser($id);
            if ($user) {
                try {
                    $this->connection->beginTransaction();
                    $sql = 'DELETE FROM accounts WHERE id = ?';
                    $stmt = $this->connection->prepare($sql);
                    $stmt->execute([$user['account_id']]);
                    $sql = 'DELETE FROM users WHERE id = ?';
                    $stmt = $this->connection->prepare($sql);
                    $stmt->execute([$id]);
                    $this->connection->commit();

                    return true;
                } catch (PDOException $e) {
                    $this->connection->rollBack();

                    return false;
                }
            }

            return false;
    }

    public function findInfoUser($account_id){
        $sql = 'SELECT * FROM users WHERE account_id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$account_id]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();

            return $user;
        }

        return false;
    }

    public function changePassword($id, $new_password){
        try {
            $new_password = md5($new_password);
            $sql = 'UPDATE accounts SET password = ? WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$new_password, $id]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createDB() {
        try {
            $sql = 'CREATE DATABASE ' . DB_NAME;
            $this->connection->exec($sql);
            $sql = 'USE ' . DB_NAME;
            $this->connection->exec($sql);
            $this->connection->beginTransaction();
            $sql = "CREATE TABLE accounts (
                    id int(11) AUTO_INCREMENT PRIMARY KEY,
                    user_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                    password varchar(400) COLLATE utf8_unicode_ci NOT NULL,
                    role int(11) NOT NULL DEFAULT 1
                )";
            $this->connection->exec($sql);
            $sql = "CREATE TABLE users (
                    id int(11) AUTO_INCREMENT PRIMARY KEY,
                    full_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                    address varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                    birth date NOT NULL,
                    account_id int(11) NOT NULL
                )";
            $this->connection->exec($sql);
            $this->connection->commit();
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $this->connection->exec("DROP DATABASE " . DB_NAME);
            die($e);
        }
    }
}
